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

use LMS\Facade\Extbase\User\StateContext;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
class User
{
    /**
     * Determine whether user is logged in
     */
    public static function isLoggedIn(): bool
    {
        return StateContext::isNotLoggedIn();
    }

    /**
     * Just syntax sugar
     */
    public static function isNotLoggedIn(): bool
    {
        return self::isLoggedIn() === false;
    }

    /**
     * Check if current user memger of a group.
     */
    public static function hasGroup(int $uid): bool
    {
        return collect(self::currentGroupList())->contains($uid);
    }

    /**
     * Get all the group names that current user has.
     */
    public static function currentGroupNames(): array
    {
        return (array)StateContext::getTypo3Context()->getPropertyFromAspect('frontend.user', 'groupNames');
    }

    /**
     * Get all the group identifiers that current user has.
     */
    public static function currentGroupList(): array
    {
        return (array)StateContext::getTypo3Context()->getPropertyFromAspect('frontend.user', 'groupIds');
    }

    /**
     * Retrieve the currently logged in user uid.
     */
    public static function currentUid(): int
    {
        return (int)StateContext::getTypo3Context()->getPropertyFromAspect('frontend.user', 'id');
    }

    /**
     * Retrieve the currently logged in user name.
     */
    public static function currentUsername(): string
    {
        return (string)StateContext::getTypo3Context()->getPropertyFromAspect('frontend.user', 'username');
    }
}
