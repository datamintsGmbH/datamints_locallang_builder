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

use LMS\Facade\Extbase\QueryBuilder;
use LMS\Facade\ObjectManageable;
use TYPO3\CMS\Core\Utility\ClassNamingUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait PropertyManagement
{
    /**
     *
     */
    public function setEntityProperty(int $uid, string $table, string $property, $value): void
    {
        $builder = QueryBuilder::getQueryBuilderFor($table)->update($table);

        $where = $builder->expr()->eq('uid', $uid);

        $builder->where($where)->set($property, $value)->execute();
    }

    /**
     *
     */
    public function setEntityProperties(int $uid, string $table, array $data): void
    {
        foreach ($data as $propertyName => $propertyValue) {
            $this->setEntityProperty($uid, $table, (string)$propertyName, $propertyValue);
        }
    }

    /**
     * Returns an array with initialized properties for requested record
     */
    public function findRaw(int $uid, string $table): array
    {
        $builder = QueryBuilder::getQueryBuilderFor($table)->select('*')->from($table);

        $where = $builder->expr()->eq('uid', $uid);

        return (array)$builder->where($where)->execute()->fetch();
    }

    /**
     * Retrieve property from table/uid association
     *
     * @return mixed
     */
    public function findRawProperty(int $uid, string $table, string $property)
    {
        return collect($this->findRaw($uid, $table))->get($property);
    }
}
