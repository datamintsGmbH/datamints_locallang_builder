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

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait PropertyHelper
{
    /**
     * @param array $keys
     *
     * @return \LMS\Facade\Assist\Collection
     */
    public function only(array $keys): Collection
    {
        return collect($this->getInitializedProperties())->only($keys);
    }

    /**
     * @param array $keys
     *
     * @return \LMS\Facade\Assist\Collection
     */
    public function except(array $keys): Collection
    {
        return collect($this->getInitializedProperties())->except($keys);
    }

    /**
     * @return array
     */
    public function getInitializedProperties(): array
    {
        $result = [];

        foreach ($this->_getProperties() as $propertyName => $propertyValue) {
            $getter = 'get' . ucfirst($propertyName);

            if (method_exists($this, $getter)) {
                $result[$propertyName] = $this->{$getter}();
            }
        }

        return $result;
    }
}
