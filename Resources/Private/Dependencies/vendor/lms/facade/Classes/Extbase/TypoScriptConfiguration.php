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
use TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException;
use TYPO3\CMS\Extbase\Configuration\{ConfigurationManager, ConfigurationManagerInterface as Configuration};

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
class TypoScriptConfiguration
{
    /**
     * Retrieve the storage page for requested extension
     *
     * @param string $extensionKey
     *
     * @return int
     */
    public static function getStoragePid(string $extensionKey): int
    {
        $ts = self::retrieveFullTypoScriptConfigurationFor($extensionKey);

        return (int)$ts['persistence.']['storagePid'] ?: 0;
    }

    /**
     * Retrieve the requested view configuration
     *
     * @param string $extensionKey
     *
     * @return array
     */
    public static function getView(string $extensionKey): array
    {
        $ts = self::retrieveFullTypoScriptConfigurationFor($extensionKey);

        return (array)$ts['view.'] ?: [];
    }

    /**
     * Get TypoScript settings area from requested extension (tx_extensionKey.settings)
     *
     * @param string $extensionKey
     *
     * @return array
     */
    public static function getSettings(string $extensionKey = 'tx_facade'): array
    {
        $ts = self::retrieveFullTypoScriptConfigurationFor($extensionKey);

        return (array)$ts['settings.'];
    }

    /**
     *  Get all TypoScript definition for the requested extension (tx_extensionKey)
     *
     * @psalm-suppress InternalMethod
     *
     * @param string $extensionKey
     *
     * @return array
     */
    public static function retrieveFullTypoScriptConfigurationFor(string $extensionKey): array
    {
        try {
            $ts = self::getConfigurationManager()
                ->getConfiguration(Configuration::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        } catch (InvalidConfigurationTypeException $e) {
            return [];
        }

        return $ts['plugin.'][$extensionKey . '.'] ?: [];
    }

    /**
     * Returns the Configuration Manager instance
     *
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-suppress LessSpecificReturnStatement
     *
     * @return \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
     */
    private static function getConfigurationManager(): ConfigurationManager
    {
        return ObjectManageable::createObject(ConfigurationManager::class);
    }
}
