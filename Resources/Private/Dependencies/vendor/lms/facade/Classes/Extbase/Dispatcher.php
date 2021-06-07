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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher as ExtbaseDispatcher;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
class Dispatcher
{
    /**
     * Dispatches a signal by calling the registered Slot methods
     *
     * @param string $class
     * @param string $signalName
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function emit(string $class, string $signalName, array $arguments = [])
    {
        try {
            return self::getDispatcherInstance()->dispatch($class, $signalName, $arguments);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Create the Extbase Dispatcher Instance
     *
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-suppress LessSpecificReturnStatement
     * @return \TYPO3\CMS\Extbase\SignalSlot\Dispatcher
     */
    public static function getDispatcherInstance(): ExtbaseDispatcher
    {
        return GeneralUtility::makeInstance(ExtbaseDispatcher::class);
    }
}
