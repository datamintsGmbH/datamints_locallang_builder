<?php
declare(strict_types = 1);

namespace LMS\Facade\Tests\Unit;

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
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * @author Borulko Sergey <borulkosergey@icloud.com>
 */
class ObjectManageableTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * Initialize
     */
    protected function setUp(): void
    {
        $this->resetSingletonInstances = true;

        parent::setUp();
    }

    /**
     * @test
     */
    public function ensureObjectCanBeCreated(): void
    {
        $context = ObjectManageable::createObject(Context::class);

        $this->assertNotEmpty($context);
        $this->assertInstanceOf(Context::class, $context);
    }

    /**
     * @test
     */
    public function ensureObjectManagerCouldBeRetrieved(): void
    {
        $this->assertInstanceOf(ObjectManager::class, ObjectManageable::getObjectManager());
    }
}
