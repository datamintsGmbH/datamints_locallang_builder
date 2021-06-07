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

use TYPO3\CMS\Extbase\Mvc\Controller\Arguments;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
class Validation
{
    /**
     * @param \TYPO3\CMS\Extbase\Mvc\Controller\Arguments $args
     *
     * @return array
     */
    public static function parseErorrs(Arguments $args): array
    {
        $errors = [];

        foreach ($args->validate()->getFlattenedErrors() as $propertyName => $propertyErrors) {
            $errors[$propertyName] = self::buildPropertyError($propertyErrors);
        }

        return $errors;
    }

    /**
     * @param array $propertyErrors
     *
     * @return array
     */
    protected static function buildPropertyError(array $propertyErrors): array
    {
        return collect($propertyErrors)->map->getMessage()->all();
    }
}
