<?php
declare(strict_types = 1);

namespace LMS\Facade\Model;

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

use LMS\Facade\Extbase\{QueryBuilder, User\StateContext};
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
class EntityTranslation
{
    /**
     * @psalm-suppress PossiblyInvalidMethodCall
     *
     * @param int    $uid
     * @param int    $language
     * @param string $table
     *
     * @return mixed
     */
    public static function findEntityForLanguage(int $uid, int $language, string $table)
    {
        $builder = QueryBuilder::getQueryBuilderFor($table);

        $constraints = [
            $builder->expr()->eq('l10n_parent', $uid),
            $builder->expr()->eq('sys_language_uid', $language),
        ];

        return $builder
            ->select(...['uid'])
            ->from($table)
            ->where(...$constraints)
            ->execute()
            ->fetchColumn();
    }

    /**
     * @param int    $uid
     * @param string $table
     *
     * @return mixed
     */
    public static function findEntityForFrontendLanguage(int $uid, string $table)
    {
        return self::findEntityForLanguage($uid, self::getFrontendLanguage(), $table);
    }

    /**
     * @return int
     */
    public static function getFrontendLanguage(): int
    {
        try {
            return (int)StateContext::getTypo3Context()->getPropertyFromAspect('language', 'id');
        } catch (AspectNotFoundException $e) {
            return 0;
        }
    }
}
