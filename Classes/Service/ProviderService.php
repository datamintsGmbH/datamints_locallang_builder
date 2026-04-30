<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Service;

use Datamints\DatamintsLocallangBuilder\Provider\AbstractProvider;
use Datamints\DatamintsLocallangBuilder\Provider\AzureProvider;
use Datamints\DatamintsLocallangBuilder\Provider\DeeplProvider;
use Datamints\DatamintsLocallangBuilder\Provider\GoogleProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ProviderService extends AbstractService
{
    protected const PROVIDER_CLASS_MAP = [
        'AzureCloud' => AzureProvider::class,
        'DeepL' => DeeplProvider::class,
        'GoogleTranslate' => GoogleProvider::class,
    ];

    /**
     * Gets the translation service provider that is configured in typoscript
     *
     * @return string
     */
    public function getConfiguredProvider(): string
    {
        return (string)($this->getExtensionConfig()['activeProvider'] ?? '');
    }

    public function getConfiguredProviderInstance(): AbstractProvider
    {
        $providerClass = $this->resolveConfiguredProviderClass();
        if ($providerClass === null) {
            throw new \TYPO3\CMS\Core\Exception('The configured Provider could not be found!');
        }

        return GeneralUtility::makeInstance($providerClass);
    }

    public function getConfiguredProviderStatus(): array
    {
        $configuredProvider = $this->getConfiguredProvider();
        if ($configuredProvider === '') {
            return [
                'provider' => '',
                'configured' => false,
                'keyConfigured' => false,
                'valid' => null,
                'message' => 'No translation provider is configured.',
                'quotaAvailable' => false,
                'quotaRemaining' => null,
                'quotaUsed' => null,
                'quotaLimit' => null,
                'quotaUnit' => null,
                'quotaMessage' => '',
                'supportedTargetLanguages' => [],
            ];
        }

        $providerClass = $this->resolveConfiguredProviderClass();
        if ($providerClass === null) {
            return [
                'provider' => $configuredProvider,
                'configured' => true,
                'keyConfigured' => false,
                'valid' => false,
                'message' => 'The configured translation provider is not supported.',
                'quotaAvailable' => false,
                'quotaRemaining' => null,
                'quotaUsed' => null,
                'quotaLimit' => null,
                'quotaUnit' => null,
                'quotaMessage' => '',
                'supportedTargetLanguages' => [],
            ];
        }

        /** @var AbstractProvider $provider */
        $provider = GeneralUtility::makeInstance($providerClass);
        if (!$provider->hasApiKey()) {
            return [
                'provider' => $provider->getName(),
                'configured' => true,
                'keyConfigured' => false,
                'valid' => null,
                'message' => 'No API key is configured for ' . $provider->getName() . '.',
                'quotaAvailable' => false,
                'quotaRemaining' => null,
                'quotaUsed' => null,
                'quotaLimit' => null,
                'quotaUnit' => null,
                'quotaMessage' => '',
                'supportedTargetLanguages' => [],
            ];
        }

        return $provider->getStatus();
    }

    protected function resolveConfiguredProviderClass(): ?string
    {
        return self::PROVIDER_CLASS_MAP[$this->getConfiguredProvider()] ?? null;
    }
}
