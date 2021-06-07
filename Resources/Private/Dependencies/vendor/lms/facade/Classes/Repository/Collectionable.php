<?php
declare(strict_types=1);

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

use LMS\Facade\Assist\Collection;
use TYPO3\CMS\Extbase\DomainObject\DomainObjectInterface;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait Collectionable
{
    /**
     * @param \TYPO3\CMS\Extbase\DomainObject\DomainObjectInterface[] $entities
     * @param array $props
     *
     * @return \LMS\Facade\Assist\Collection
     */
    public function toCollection(array $entities, array $props = []): Collection
    {
        $result = collect(
            array_map(function (DomainObjectInterface $entity) {
                return collect($this->callObjectGetters($entity));
            }, $entities)
        );

        return $result->when((bool)$props, static function (Collection $collection) use ($props) {
            return $collection->map->only($props);
        });
    }

    /**
     * @param \TYPO3\CMS\Extbase\DomainObject\DomainObjectInterface $entity
     * @return array
     */
    public function callObjectGetters(DomainObjectInterface $entity): array
    {
        $result = [];

        foreach ($entity->_getProperties() as $propertyName => $propertyValue) {
            $getter = 'get' . ucfirst($propertyName);

            if (method_exists($entity, $getter)) {
                $result[$propertyName] = $entity->{$getter}();
            }
        }

        return $result;
    }
}
