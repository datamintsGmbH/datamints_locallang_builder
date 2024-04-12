<?php

namespace Datamints\DatamintsLocallangBuilder\Service\Traits;

trait FileServiceTrait
{
    /**
     * fileService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Service\FileService
     */
    protected $fileService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Service\FileService $fileService
     */
    public function injectFileService(\Datamints\DatamintsLocallangBuilder\Service\FileService $fileService)
    {
        $this->fileService = $fileService;
    }
}
