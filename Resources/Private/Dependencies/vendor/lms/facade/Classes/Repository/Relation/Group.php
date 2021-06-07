<?php
declare(strict_types = 1);

namespace LMS\Facade\Repository\Relation;

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

use LMS\Facade\Assist\Collection;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait Group
{
    /**
     * @param array $uidList
     * @param array $props
     *
     * @return \LMS\Facade\Assist\Collection
     */
    public function findByGroups(array $uidList, array $props = []): Collection
    {
        $entities = [];

        foreach ($uidList as $groupUid) {
            $entities[] = $this->findByGroup($groupUid, $props);
        }

        return Collection::make($entities)->collapse()->unique();
    }

    /**
     * @param int $group
     * @param array $props
     * @return \LMS\Facade\Assist\Collection
     */
    public function findByGroup(int $group, array $props = []): Collection
    {
        $query = $this->createQuery();

        try {
            $constraints = $query->contains($this->getGroupPropertyName(), [$group]);
        } catch (\Exception $e) {
            return [];
        }

        return $this->toCollection($query->matching($constraints)->execute()->toArray(), $props);
    }

    /**
     * @return \LMS\Facade\Assist\Collection
     */
    public function findWithoutGroups(): Collection
    {
        $query = $this->createQuery();
        $constraints = $query->equals($this->getGroupPropertyName(), 0);

        return Collection::make(
            $query->matching($constraints)->execute()->toArray()
        );
    }

    /**
     * Could be overwritten in certain cases, when property has different name
     *
     * @return string
     */
    protected function getGroupPropertyName(): string
    {
        return 'group';
    }
}
