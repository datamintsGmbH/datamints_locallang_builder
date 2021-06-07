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
use TYPO3\CMS\Extbase\{Object\ObjectManagerInterface, Persistence\Generic\PersistenceManager};

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait StaticCreation
{
    /**
     * ExampleRepository::make()->findAll();
     *
     * Allow to create a fresh repository instance by static method ::make()
     *
     * @return $this
     */
    public static function make(): self
    {
        return new static(ObjectManageable::getObjectManager());
    }

    /**
     * @psalm-suppress ArgumentTypeCoercion
     *
     * @param \TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        parent::__construct($objectManager);

        $this->injectPersistenceManager(
            ObjectManageable::createObject(PersistenceManager::class)
        );

        $this->initializeObject();
    }

    /**
     * This method should be defined here because we need to call it manually, not by Extbase magic
     */
    protected function initializeObject(): void
    {
    }
}
