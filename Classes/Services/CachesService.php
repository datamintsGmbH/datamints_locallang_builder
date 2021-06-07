<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de)
 */

namespace Datamints\DatamintsLocallangBuilder\Services;

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class CachesService extends AbstractService
{
    const DEFAULT_CACHE_IDENTIFIER = 'datamintslocallangbuilder_cache';

    /**
     * @var \TYPO3\CMS\Core\Cache\CacheManager
     */
    protected $cacheManager;

    /**
     * Sets a cache entity
     *
     * @param string $identifier
     * @param mixed  $value
     * @param string $tag
     *
     * @throws \TYPO3\CMS\Core\Cache\Exception\NoSuchCacheException
     */
    public function set(string $identifier, $value, string $tag = 'undefined'): void
    {
        $cache = $this->cacheManager->getCache(self::DEFAULT_CACHE_IDENTIFIER);
        $cache->set($identifier, $value, [$tag]);
    }

    /**
     * Checks if cache entity exists
     *
     * @param string $identifier
     *
     * @return bool
     */
    public function has(string $identifier): bool
    {
        $cache = $this->cacheManager->getCache(self::DEFAULT_CACHE_IDENTIFIER);
        return $cache->has($identifier);
    }

    /**
     * Gets cache entity
     *
     * @param string $identifier
     *
     * @return mixed
     */
    public function get(string $identifier)
    {
        $cache = $this->cacheManager->getCache(self::DEFAULT_CACHE_IDENTIFIER);
        return $cache->get($identifier);
    }

    /**
     * clearSiteCache
     *
     * @return void
     */
    public function clearSiteCache(): void
    {
        /** @var \TYPO3\CMS\Core\Cache\CacheManager $cacheManager */
        $cacheManager = GeneralUtility::makeInstance(CacheManager::class);
        $cacheManager->flushCaches();
    }

    /**
     * clearExtensionCache
     *
     * @return void
     */
    public function clearOwnCache(): void
    {
        $cache = $this->cacheManager->getCache(self::DEFAULT_CACHE_IDENTIFIER);
        $cache->flush();
    }

    /**
     * @param \TYPO3\CMS\Core\Cache\CacheManager $cacheManager
     */
    public function injectCacheManager(\TYPO3\CMS\Core\Cache\CacheManager $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }
}
