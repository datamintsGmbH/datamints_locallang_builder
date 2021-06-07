<?php
declare(strict_types = 1);

namespace LMS\Facade\Repository;

/* * *************************************************************
 *
 *  Copyright notice
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

use LMS\Facade\ObjectManageable;
use TYPO3\CMS\Core\Utility\ClassNamingUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait CRUD
{
    /**
     * @param \TYPO3\CMS\Extbase\DomainObject\AbstractEntity $object
     *
     * @return bool
     */
    public function destroy(AbstractEntity $object = null): bool
    {
        if (!$object) {
            return false;
        }

        try {
            $this->remove($object);
        } catch (\Exception $e) {
            return false;
        }

        $this->getPersistenceManager()->persistAll();

        return true;
    }

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
     * @psalm-suppress InternalMethod
     *
     * @param array $properties
     *
     * @return \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
     */
    public function produce(array $properties = []): AbstractEntity
    {
        /** @var AbstractEntity $object */
        $object = ObjectManageable::createObject($this->getEntityClassName());

        foreach ($properties as $propertyName => $propertyValue) {
            $object->_setProperty($propertyName, $propertyValue);
        }

        return $object;
    }

    /**
     * @param \TYPO3\CMS\Extbase\DomainObject\AbstractEntity $entity
     *
     * @return bool
     */
    public function persist(AbstractEntity $entity): bool
    {
        try {
            $this->add($entity);
        } catch (\Exception $e) {
            return false;
        }

        $this->getPersistenceManager()->persistAll();

        return true;
    }

    /**
     * @return string
     */
    public function getEntityClassName(): string
    {
        return ClassNamingUtility::translateRepositoryNameToModelName(
            $this->getRepositoryClassName()
        );
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
