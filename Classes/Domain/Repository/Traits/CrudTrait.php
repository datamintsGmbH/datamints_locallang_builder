<?php

declare(strict_types=1);

namespace Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

trait CrudTrait
{

    /**
     * @param \TYPO3\CMS\Extbase\DomainObject\AbstractEntity $object
     *
     * @return \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
     */
    public function upgrade(AbstractEntity $object): AbstractEntity
    {
        try {
            $this->update($object);
        } catch (\Exception $e) {
            return $object;
        }

        $this->getPersistenceManager()->persistAll();

        return $object;
    }

    /**
     * @psalm-suppress MoreSpecificReturnType
     * @return \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     */
    private function getPersistenceManager(): PersistenceManager
    {
        return $this->persistenceManager;
    }
}
