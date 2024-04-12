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
     * Checks whether the extension is excluded or not. The list is defined in TS (settings.excludedExtensions)
     *
     * @param string $extensionKey
     *
     * @return bool
     */
    protected function isExtensionKeyExcluded (string $extensionKey): bool
    {
        /** @var array $explodedExcludedExtensions */
        $explodedExcludedExtensions = explode(',', $this->getSettings()['excludedExtensions']);
        /** @var TYPE_NAME $explodedExcludedExtension */
        foreach ($explodedExcludedExtensions as $explodedExcludedExtension) {
            if (trim($extensionKey) === trim($explodedExcludedExtension)) {
                return true;
            }
        }
        return false;
    }
}
