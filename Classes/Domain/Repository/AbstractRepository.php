<?php

namespace Datamints\DatamintsLocallangBuilder\Domain\Repository;


use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Qom\AndInterface;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\CrudTrait;

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */
abstract class AbstractRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    use CrudTrait;

    /**
     * @var string
     */
    protected $modelTableName;


    /**
     * @return ConfigurationManagerInterface
     */
    public function getConfigurationManager ()
    {
        return $this->objectManager->get(ConfigurationManagerInterface::class);
    }

    /**
     *
     * @param array $constraints Bedingungen
     * @param array $ordering    Sortierung
     * @param bool  $ignoreEnableFields
     * @param bool  $respectSysLanguage
     * @param bool  $respectStoragePage
     * @param bool  $includeDeleted
     *
     * @param bool  $returnSingle
     *
     * @return array|object|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findGenericByConstraints ($constraints = [], $ordering = null, $ignoreEnableFields = true, $respectSysLanguage = false, $respectStoragePage = false, $includeDeleted = false, $returnSingle = false)
    {
        if (!$ordering) {
            $ordering = ['uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];
        }

        $query = $this->createQuery();
        $querySettings = $query->getQuerySettings();
        $querySettings->setIgnoreEnableFields($ignoreEnableFields);
        $querySettings->setRespectSysLanguage($respectSysLanguage);
        $querySettings->setRespectStoragePage($respectStoragePage);
        $querySettings->setIncludeDeleted($includeDeleted);

        $constraints = $this->buildConstraints($query, $constraints);


        $query->matching(
            $query->logicalAnd($constraints)
        );
        $query->setOrderings($ordering);

        // Output-Möglichkeit, um den raw query auszugeben
        if (1 == 0) {
            $queryParser = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser::class);
            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($queryParser->convertQueryToDoctrineQueryBuilder($query)->getSQL(), 'SQL');
            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($queryParser->convertQueryToDoctrineQueryBuilder($query)->getParameters(), 'SQL-Params');
        }
        if ($returnSingle) {
            return $query->execute()->getFirst();
        }
        return $query->execute();
    }

    /**
     *
     *
     * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
     * @param array                                         $additionalConstraints
     *
     * @return array
     */
    protected function buildConstraints ($query, $additionalConstraints)
    {
        $constraints = [];
        /** @var \Datamints\DatamintsLocallangBuilder\Domain\Model\Constraint $additionalConstraint */
        foreach ($additionalConstraints as $additionalConstraint) {
            $operator = '';
            switch ($additionalConstraint->getType()) {
                case \TYPO3\CMS\Extbase\Persistence\QueryInterface::OPERATOR_EQUAL_TO:
                    $operator = 'equals';
                    break;
                case \TYPO3\CMS\Extbase\Persistence\QueryInterface::OPERATOR_GREATER_THAN:
                    $operator = 'greaterThan';
                    break;
                case \TYPO3\CMS\Extbase\Persistence\QueryInterface::OPERATOR_LESS_THAN:
                    $operator = 'lessThan';
                    break;
                case \TYPO3\CMS\Extbase\Persistence\QueryInterface::OPERATOR_CONTAINS:
                    $operator = 'contains';
                    break;
                case \TYPO3\CMS\Extbase\Persistence\QueryInterface::OPERATOR_IN:
                    $operator = 'in';
                    break;
                default:
                    break;
            }
            $constraints[] = $query->{$operator}($additionalConstraint->getProperty(), $additionalConstraint->getValue());
        }
        return $constraints;
    }

    /**
     * @param \TYPO3\CMS\Extbase\DomainObject\AbstractEntity $entity
     */
    public function save ($entity)
    {
        if ($entity->getUid()) {
            $this->update($entity);
        } else {
            $this->add(($entity));
        }

        $this->persistenceManager->persistAll();
    }

    /**
     * @param int[] $uids
     *
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function findByUids ($uids)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->in('uid', $uids)
        );

        return $query->execute();
    }

    /**
     * Removes all entries for this table. If you also want to delete the related sub-ojects, better use the native removeAll-Function
     * Thats a quick method, because the other method takes about 1 minute to execute
     */
    public function removeAllQuick ()
    {
        $tableName = $this->getTableName();

        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable($tableName);
        $queryBuilder->truncate($tableName);
    }

    /**
     * Return the current tablename
     *
     * @return string
     */
    protected function getTableName (): string
    {
        if (!$this->modelTableName) {
            throw new \TYPO3\CMS\Core\Exception('No model table name defined');
        }
        return $this->modelTableName;
    }

    /**
     * @param QueryInterface  $query
     * @param string          $propertyName
     * @param int|string|null $minTimestamp
     * @param int|string|null $maxTimestamp
     *
     * @return AndInterface|null
     */
    protected function createTimeFrameConstraint ($query, $propertyName, $minTimestamp = null, $maxTimestamp = null)
    {
        $constraints = [];
        if ($minTimestamp) {
            $constraints[] = $query->greaterThanOrEqual($propertyName, $minTimestamp);
        }
        if ($maxTimestamp) {
            $constraints[] = $query->lessThanOrEqual($propertyName, $maxTimestamp);
        }
        if (!$constraints) {
            return null;
        }
        return $query->logicalAnd($constraints);
    }
}
