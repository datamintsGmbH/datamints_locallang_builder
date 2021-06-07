<?php
declare(strict_types = 1);

namespace LMS\Facade\Model\Property;

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

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait User
{
    /**
     * @var int
     */
    protected $user = 0;

    /**
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
    }

    /**
     * @param int $user
     */
    public function setUser(int $user): void
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function fetchRawUser(): array
    {
        $builder = QueryBuilder::getQueryBuilderFor('fe_users');

        $constraints = [
            $builder->expr()->eq('uid', $this->getUser()),
        ];

        return $builder
            ->select('*')
            ->from('fe_users')
            ->where(...$constraints)
            ->execute()
            ->fetch();
    }

    /**
     * @param string $property
     *
     * @return mixed
     */
    public function fetchUserProperty(string $property)
    {
        return $this->fetchRawUser()[$property];
    }
}
