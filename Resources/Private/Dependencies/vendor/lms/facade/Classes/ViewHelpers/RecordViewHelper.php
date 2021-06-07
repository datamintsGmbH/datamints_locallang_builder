<?php
declare(strict_types = 1);

namespace LMS\Facade\ViewHelpers;

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

use LMS\Facade\Repository\PageRepository;

/**
 * @author Borulko Sergey <borulkosergey@icloud.com>
 */
class RecordViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * {@inheritDoc}
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('uid', 'int', '', true);
        $this->registerArgument('table', 'string', '', true);
    }

    /**
     * Retrieve the raw database info for the table/uid relation.
     */
    public function render(): array
    {
        $uid = (int)$this->arguments['uid'];
        $table = (string)$this->arguments['table'];

        return PageRepository::make()->findRaw($uid, $table);
    }
}
