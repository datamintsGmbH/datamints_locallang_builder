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
            if($extensionDTO['local']) {
                $extensionObjects[] = $this->manifestBuildService->getExtensionPart($extensionDTO);
            }
        }
        if(ManifestBuildService::PERSIST) {
            DatabaseUtility::persistAll();
        }

        return $extensionObjects;
    }
}
