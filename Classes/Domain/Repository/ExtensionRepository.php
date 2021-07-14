<?php
namespace Datamints\DatamintsLocallangBuilder\Domain\Repository;

use Datamints\DatamintsLocallangBuilder\Domain\Model\Constraint;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;

/**
 * This file is part of the "datamints_locallang_builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * The repository for Extensions
 */
class ExtensionRepository extends AbstractRepository
{
    protected $modelTableName = 'tx_datamintslocallangbuilder_domain_model_extension';

    /**
     * @var array
     */
    protected $defaultOrderings = ['sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];

    /**
     * Finds one record by name
     * 
     * @param string $name Name of the extension-entity
     * @return array|object|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findOneByName(string $name)
    {
        return $this->findGenericByConstraints(
        [new Constraint(\TYPO3\CMS\Extbase\Persistence\QueryInterface::OPERATOR_EQUAL_TO, 'name', $name)], 
        null, 
        true, 
        false, 
        false, 
        false, 
        true
        );
    }
}
