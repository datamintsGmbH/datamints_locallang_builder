<?php
declare(strict_types = 1);

namespace LMS\Facade\Logger;

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

use Psr\Log\LoggerInterface;
use LMS\Facade\ObjectManageable;
use TYPO3\CMS\Core\Log\{LogManager, LogManagerInterface};

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
class Logger
{
    /**
     * @param string $class
     *
     * @return \Psr\Log\LoggerInterface
     */
    public static function get(string $class = ''): LoggerInterface
    {
        return self::logManager()->getLogger($class ?: __CLASS__);
    }

    /**
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-suppress LessSpecificReturnStatement
     * @return \TYPO3\CMS\Core\Log\LogManagerInterface
     */
    public static function logManager(): LogManagerInterface
    {
        return ObjectManageable::createObject(LogManager::class);
    }
}
