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

/**
 * @usage  self::extensionTypoScriptKey()
 * @usage  self::extensionExtbaseKey()
 * @usage  self::extensionNamespace()
 *
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait ExtensionHelper
{
    /**
     * Input: \LMS\Facade\Extbase\ExtensionHelper'
     * Output: Facade
     *
     * @return string
     */
    public static function extensionExtbaseKey(): string
    {
        $namespaceParts = self::extensionNamespace();
        $className = array_slice($namespaceParts, 1, 1);

        return array_shift($className);
    }

    /**
     * Input: Facade
     * Output: tx_facade
     *
     * @return string
     */
    public static function extensionTypoScriptKey(): string
    {
        return 'tx_' . strtolower(self::extensionExtbaseKey());
    }

    /**
     * Input: \LMS\Facade\Extbase\ExtensionHelper'
     * Output:
     *  [
     *      0 => 'LMS',
     *      1 => 'Facade',
     *      2 => 'Extbase',
     *      3 => 'ExtensionHelper'
     *  ]
     *
     * @return array
     */
    public static function extensionNamespace(): array
    {
        return explode('\\', get_called_class());
    }
}
