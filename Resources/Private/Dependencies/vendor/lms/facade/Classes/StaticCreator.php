<?php
declare(strict_types = 1);

namespace LMS\Facade;

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

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait StaticCreator
{
    /**
     * @param array $arguments
     *
     * @return $this
     */
    public static function make(...$arguments): self
    {
        return new static(...$arguments);
    }

    /**
     * @psalm-suppress MoreSpecificReturnType
     *
     * @param array $properties
     *
     * @return $this
     */
    public static function makeWithProps(array $properties = []): self
    {
        $entity = new static();

        foreach ($properties as $propertyName => $propertyValue) {
            $entity->_setProperty($propertyName, $propertyValue);
        }

        return $entity;
    }
}
