<?php
declare(strict_types = 1);

namespace LMS\Facade\Extbase;

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
use TYPO3\CMS\Core\Registry as CoreRegistry;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
class Registry
{
    /**
     * @param string $namespace
     * @param string $key
     */
    public static function reset(string $namespace, string $key): void
    {
        self::set($namespace, $key, 0);
    }

    /**
     * @param string $namespace
     * @param string $key
     */
    public static function increment(string $namespace, string $key): void
    {
        $counter = (int)self::get($namespace, $key) + 1;

        self::set($namespace, $key, $counter);
    }

    /**
     * @param string $namespace
     * @param string $key
     *
     * @return mixed
     */
    public static function pull(string $namespace, string $key)
    {
        $value = self::get($namespace, $key);

        self::remove($namespace, $key);

        return $value;
    }

    /**
     * @param string $namespace
     * @param string $key
     * @param mixed  $value
     */
    public static function set(string $namespace, string $key, $value): void
    {
        self::registry()->set($namespace, $key, $value);
    }

    /**
     * @param string $namespace
     * @param string $key
     *
     * @return mixed
     */
    public static function get(string $namespace, string $key)
    {
        return self::registry()->get($namespace, $key);
    }

    /**
     * @param string $namespace
     * @param string $key
     */
    public static function remove(string $namespace, string $key): void
    {
        self::registry()->remove($namespace, $key);
    }

    /**
     * @param string $namespace
     * @param string $key
     *
     * @return bool
     */
    public static function contains(string $namespace, string $key): bool
    {
        return (bool)self::registry()->get($namespace, $key);
    }

    /**
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-suppress LessSpecificReturnStatement
     * @return \TYPO3\CMS\Core\Registry
     */
    public static function registry(): CoreRegistry
    {
        return ObjectManageable::createObject(CoreRegistry::class);
    }
}
