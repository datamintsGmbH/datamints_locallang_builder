<?php
declare(strict_types = 1);

namespace LMS\Facade\Utility;

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
use TYPO3\CMS\Core\DataHandling\DataHandler;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
class CommandUtility
{
    /**
     * Executes the passed action for any table that has been set.
     *
     * @psalm-suppress PossiblyUndefinedVariable
     *
     * @param string $table      [tx_extension_domain_model_table]
     * @param string $uid        [ NEWbe68s587 ]
     * @param array  $properties ['title' => 'Hey' ]
     */
    public static function handle(string $table, string $uid, array $properties): void
    {
        $data[$table][$uid] = $properties;

        self::handleRaw($data);
    }

    /**
     * @param array $data
     */
    public static function handleRaw(array $data): void
    {
        self::execute($data);
    }

    /**
     * @param array $data
     */
    private static function execute(array $data): void
    {
        $tce = self::dataHandler();

        $tce->start($data, []);

        $tce->process_datamap();
    }

    /**
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-suppress LessSpecificReturnStatement
     * @return \TYPO3\CMS\Core\DataHandling\DataHandler
     */
    private static function dataHandler(): DataHandler
    {
        return ObjectManageable::createObject(DataHandler::class);
    }
}
