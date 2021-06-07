<?php
declare(strict_types = 1);

namespace LMS\Facade\Model\Property;

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

use Carbon\Carbon;
use LMS\Facade\Extbase\QueryBuilder;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait IsOnline
{
    /**
     * @var int
     */
    protected $isOnline = 0;

    /**
     * Clear the activity time
     */
    public function resetOnlineTime(): void
    {
        $this->isOnline = 0;
    }

    /**
     * @return bool
     */
    public function getOnline(): bool
    {
        return $this->hasActiveSession() || $this->wasActiveRecently();
    }

    /**
     * @psalm-suppress PossiblyInvalidMethodCall
     * @psalm-suppress InternalMethod
     *
     * @return bool
     */
    public function hasActiveSession(): bool
    {
        $builder = QueryBuilder::getQueryBuilderFor('fe_sessions');

        $where = [$builder->expr()->eq('ses_userid', $this->getUid())];

        return (bool)$builder->count('ses_userid')->from('fe_sessions')->where(...$where)->execute()->fetchColumn();
    }

    /**
     * @return bool
     */
    public function wasActiveRecently(): bool
    {
        return $this->isOnline > 0 && Carbon::createFromTimestamp($this->isOnline)->diffInMinutes(Carbon::now()) <= 1;
    }
}
