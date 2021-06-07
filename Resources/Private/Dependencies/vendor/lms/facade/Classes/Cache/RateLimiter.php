<?php
declare(strict_types = 1);

namespace LMS\Facade\Cache;

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

use TYPO3\CMS\Core\Cache\CacheManager;
use LMS\Facade\{Traits\InteractsWithTime, ObjectManageable, StaticCreator};

/**
 * @psalm-suppress PropertyNotSetInConstructor
 * @author         Sergey Borulko <borulkosergey@icloud.com>
 */
class RateLimiter
{
    use InteractsWithTime, StaticCreator;

    /**
     * The cache store implementation.
     *
     * @var \TYPO3\CMS\Core\Cache\Frontend\FrontendInterface
     */
    private $cache;

    /**
     * @param string $extKey
     */
    public function __construct(string $extKey)
    {
        $manager = ObjectManageable::createObject(CacheManager::class);

        $this->cache = $manager->getCache($extKey);
    }

    /**
     * Determine if the given key has been "accessed" too many times.
     *
     * @param string $key
     * @param int    $maxAttempts
     *
     * @return bool
     */
    public function tooManyAttempts(string $key, int $maxAttempts): bool
    {
        if ($this->attempts($key) >= $maxAttempts) {
            return $this->cache->has($key . '_timer');
        }

        return false;
    }

    /**
     * Increment the counter for a given key for a given decay time.
     *
     * @param string $key
     * @param int    $decayMinutes
     *
     */
    public function hit(string $key, int $decayMinutes = 1): void
    {
        $this->cache->set(
            $key . '_timer', $this->availableAt($decayMinutes), [], $decayMinutes
        );

        $hits = (int)$this->cache->get($key) + 1;

        $this->cache->set($key, $hits, [], $decayMinutes);
    }

    /**
     * Get the number of attempts for the given key.
     *
     * @param string $key
     *
     * @return int
     */
    public function attempts(string $key): int
    {
        return (int)$this->cache->get($key) ?: 0;
    }

    /**
     * Reset the number of attempts for the given key.
     *
     * @param string $key
     *
     * @return bool
     */
    public function resetAttempts(string $key): bool
    {
        return $this->cache->remove($key);
    }

    /**
     * Clear the hits and lockout timer for the given key.
     *
     * @param string $key
     */
    public function clear(string $key): void
    {
        $this->resetAttempts($key);

        $this->cache->remove($key . '_timer');
    }

    /**
     * Get the number of seconds until the "key" is accessible again.
     *
     * @param string $key
     *
     * @return int
     */
    public function availableIn(string $key): int
    {
        if ($releaseTime = $this->cache->get($key . '_timer')) {
            return $releaseTime - time();
        }

        return 0;
    }
}
