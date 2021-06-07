<?php
declare(strict_types = 1);

namespace LMS\Facade\Assist;

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
class Optional implements \ArrayAccess
{
    use Traits\Macroable {
        __call as macroCall;
    }

    /**
     * The underlying object.
     *
     * @var mixed
     */
    protected $value;

    /**
     * Create a new optional instance.
     *
     * @param mixed $value
     *
     * @return void
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Dynamically access a property on the underlying object.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        if (is_object($this->value)) {
            return $this->value->{$key};
        }
    }

    /**
     * Dynamically pass a method to the underlying object.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        if (is_object($this->value)) {
            return $this->value->{$method}(...$parameters);
        }
    }

    /**
     * Determine if an item exists at an offset.
     *
     * @param mixed $key
     *
     * @return bool
     */
    public function offsetExists($key)
    {
        return Arr::accessible($this->value) && Arr::exists($this->value, $key);
    }

    /**
     * Get an item at a given offset.
     *
     * @param mixed $key
     *
     * @return mixed
     */
    public function offsetGet($key)
    {
        return Arr::get($this->value, $key);
    }

    /**
     * Set the item at a given offset.
     *
     * @param mixed $key
     * @param mixed $value
     *
     * @return void
     */
    public function offsetSet($key, $value)
    {
        if (Arr::accessible($this->value)) {
            $this->value[$key] = $value;
        }
    }

    /**
     * Unset the item at a given offset.
     *
     * @param string $key
     *
     * @return void
     */
    public function offsetUnset($key)
    {
        if (Arr::accessible($this->value)) {
            unset($this->value[$key]);
        }
    }
}
