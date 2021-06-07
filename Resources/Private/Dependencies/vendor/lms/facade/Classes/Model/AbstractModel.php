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

use LMS\Facade\Assist\Collection;
use LMS\Facade\Extbase\{ExtensionHelper, TypoScriptConfiguration};

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
abstract class AbstractModel extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    use StorageActions, ExtensionHelper, PropertyHelper;

    /**
     * @return array
     */
    public static function settings(): array
    {
        return TypoScriptConfiguration::getSettings(
            self::extensionTypoScriptKey()
        );
    }

    /**
     * @param array $props
     * @return \LMS\Facade\Assist\Collection
     */
    public function toCollection(array $props = []): Collection
    {
        return $this->repository()->toCollection([$this], $props)->first()->filter();
    }
}
