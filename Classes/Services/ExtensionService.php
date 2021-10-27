<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Services;


use Datamints\DatamintsLocallangBuilder\Utility\DatabaseUtility;
use Datamints\DatamintsLocallangBuilder\Services\Traits\ManifestBuildServiceTrait;

class ExtensionService extends AbstractService
{
    use \Datamints\DatamintsLocallangBuilder\Services\Traits\CachesServiceTrait;

    use ManifestBuildServiceTrait;

    /**
     * Gets all loaded extensions and returns them
     *
     * @param array extensionsList
     *
     * @return array
     */
    public function getExtensionManifest(array $extensionsList): array
    {

        $extensionObjects = [];

        foreach ($extensionsList as $extensionDTO) {
            if($extensionDTO['local'] && !$this->isExtensionKeyExcluded($extensionDTO['key'])) {
                $extensionObjects[] = $this->manifestBuildService->getExtensionPart($extensionDTO);
            }
        }
        if(ManifestBuildService::PERSIST) {
            DatabaseUtility::persistAll();
        }

        return $extensionObjects;
    }

    /**
     * Checks whether the extension is excluded or not. The list is defined in TS (settings.excludedExtensions)
     *
     * @param string $extensionKey
     *
     * @return bool
     */
    protected function isExtensionKeyExcluded(string $extensionKey): bool
    {
        /** @var array $explodedExcludedExtensions */
        $explodedExcludedExtensions = explode(',', $this->getSettings()['excludedExtensions']);
        /** @var TYPE_NAME $explodedExcludedExtension */
        foreach ($explodedExcludedExtensions as $explodedExcludedExtension) {
            if(trim($extensionKey) === trim($explodedExcludedExtension)) {
                return true;
            }
        }
        return false;
    }
}
