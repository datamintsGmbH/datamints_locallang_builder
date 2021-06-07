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
use TYPO3\CMS\Core\Collection\CollectionInterface;
use TYPO3\CMS\Frontend\Category\Collection\CategoryCollection;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait Category
{
    /**
     * @param array $categories
     *
     * @return \LMS\Facade\Assist\Collection
     */
    public function findByCategories(array $categories): Collection
    {
        $entities = [];

        foreach ($categories as $categoryId) {
            $entities[] = $this->findOneByCategory((int)$categoryId);
        }

        return Collection::make($entities)->collapse()->unique();
    }

    /**
     * @param int $category
     *
     * @return \LMS\Facade\Assist\Collection
     */
    public function findOneByCategory(int $category): Collection
    {
        $query = $this->createQuery();

        $query->matching(
            $query->contains('categories', $category)
        );

        return Collection::make($query->execute()->toArray());
    }

    /**
     * @param int $category
     *
     * @return \TYPO3\CMS\Core\Collection\CollectionInterface
     */
    protected function getRecordsAssociatedWithCategory(int $category): CollectionInterface
    {
        return CategoryCollection::load($category, true, $this->getTable());
    }

    /**
     * Should return the table name
     *
     * @return string
     */
    abstract function getTable(): string;
}
