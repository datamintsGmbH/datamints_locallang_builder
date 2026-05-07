<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Service;


use Datamints\DatamintsLocallangBuilder\Utility\DatabaseUtility;
use Datamints\DatamintsLocallangBuilder\Service\Traits\ManifestBuildServiceTrait;
use Datamints\DatamintsLocallangBuilder\Utility\LogUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class ExtensionService extends AbstractService
{
    use \Datamints\DatamintsLocallangBuilder\Service\Traits\CachesServiceTrait;

    use ManifestBuildServiceTrait;

    /**
     * Gets all loaded extensions and returns them
     *
     * @param array extensionsList
     *
     * @return array
     */
    public function getExtensionManifest (array $extensionsList): array
    {
        LogUtility::log(self::class . ': Beginning to build the extension Manifests');

        $extensionObjects = [];
        foreach ($extensionsList as $extensionDTO) {
            LogUtility::log(self::class . ': Beginning Extension Manifest for EXT:' . $extensionDTO['key']);
            if (!$this->isExtensionKeyExcluded($extensionDTO['key'])) {
                $extensionObjects[] = $this->manifestBuildService->getExtensionPart($extensionDTO);
            }
            LogUtility::log(self::class . ': Finished Extension Manifest for EXT:' . $extensionDTO['key']);
        }
        if (ManifestBuildService::PERSIST) {
            DatabaseUtility::persistAll();
        }

        LogUtility::log(self::class . ': Finished to build the extension Manifests');


        return $extensionObjects;
    }

    /**
     * Checks whether the extension is excluded or not.
     * If allowed extensions are configured in TS (settings.allowedExtensions),
     * they take precedence over settings.excludedExtensions.
     *
     * @param string $extensionKey
     *
     * @return bool
     */
    protected function isExtensionKeyExcluded (string $extensionKey): bool
    {
        $normalizedExtensionKey = trim($extensionKey);
        $allowedExtensions = $this->getConfiguredExtensionList('allowedExtensions');
        if ($allowedExtensions !== []) {
            return !in_array($normalizedExtensionKey, $allowedExtensions, true);
        }

        return in_array($normalizedExtensionKey, $this->getConfiguredExtensionList('excludedExtensions'), true);
    }

    /**
     * @param string $settingKey
     *
     * @return array
     */
    protected function getConfiguredExtensionList(string $settingKey): array
    {
        $settings = $this->getSettings();
        $configuredExtensions = preg_split('/[,;\/]/', (string)($settings[$settingKey] ?? '')) ?: [];

        return array_values(
            array_filter(
                array_map('trim', $configuredExtensions),
                static function (string $extensionKey): bool {
                    return $extensionKey !== '';
                }
            )
        );
    }
}
