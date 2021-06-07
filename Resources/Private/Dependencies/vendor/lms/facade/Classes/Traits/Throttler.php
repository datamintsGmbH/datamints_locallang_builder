<?php
declare(strict_types = 1);

namespace LMS\Facade\Traits;

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

use Symfony\Component\HttpFoundation\Request;
use LMS\Facade\{Cache\RateLimiter, Extbase\ExtensionHelper};

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait Throttler
{
    use ExtensionHelper;

    /**
     * Determine if the session has too many attempts
     *
     * @return bool
     */
    protected function hasTooManyAttempts(): bool
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey(), $this->maxAttempts()
        );
    }

    /**
     * Increment the attempts count for the session.
     */
    protected function incrementAttempts(): void
    {
        $this->limiter()->hit(
            $this->throttleKey(), $this->decayMinutes() * 60
        );
    }

    /**
     * Clear registered attempts associated with REQUEST IP
     */
    protected function clearAttempts(): void
    {
        $this->limiter()->clear($this->throttleKey());
    }

    /**
     * Use request ip address as a throttle key
     *
     * @return string
     */
    protected function throttleKey(): string
    {
        return md5(Request::createFromGlobals()->getClientIp() ?? '');
    }

    /**
     * Get the rate limiter instance.
     *
     * @return \LMS\Facade\Cache\RateLimiter
     */
    protected function limiter(): RateLimiter
    {
        return RateLimiter::make(self::extensionTypoScriptKey());
    }

    /**
     * Get the maximum number of attempts to allow.
     *
     * @return int
     */
    abstract public function maxAttempts(): int;

    /**
     * Get the number of minutes to throttle for.
     *
     * @return int
     */
    abstract protected function decayMinutes(): int;
}
