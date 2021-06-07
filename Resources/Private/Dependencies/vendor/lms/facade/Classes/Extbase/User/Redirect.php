<?php
declare(strict_types = 1);

namespace LMS\Facade\Extbase\User;

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

use TYPO3\CMS\Core\Utility\HttpUtility;
use LMS\Facade\Extbase\Redirect as ExtbaseRedirect;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
class Redirect
{
    /**
     * Force redirect to Unauthorised Page
     */
    public static function redirectUnauthorised(): void
    {
        ExtbaseRedirect::toUri('/401', HttpUtility::HTTP_STATUS_401);
    }

    /**
     * Force redirect to Forbidden Page
     */
    public static function redirectForbidden(): void
    {
        ExtbaseRedirect::toUri('/403', HttpUtility::HTTP_STATUS_403);
    }
}
