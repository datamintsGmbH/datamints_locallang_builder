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

use LMS\Facade\Cache\Manager;
use LMS\Facade\ObjectManageable;
use TYPO3\CMS\Extbase\{Object\ObjectManagerInterface, Persistence\Generic\PersistenceManager};
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait CacheQuery
{
    /**
     * @return mixed
     */
    protected static function cacheProxy(\Closure $resultProvider, array $params)
    {
        $class = class_basename(get_called_class());
        $method = debug_backtrace()[1]['function'];

        $cacheKey = $class . '%' . $method . '%' . implode('_', $params);

        if ($hit = static::cacheManager()->take($cacheKey)) {
            return $hit;
        }

        if (static::cacheManager()->has($cacheKey)) {
            return null;
        }

        return static::cacheManager()->put($cacheKey, $resultProvider());
    }

    protected static function cacheManager(): Manager
    {
        return Manager::make(
            static::extensionTypoScriptKey()
        );
    }
}
