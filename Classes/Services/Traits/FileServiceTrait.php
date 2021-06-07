<?php

namespace Datamints\DatamintsLocallangBuilder\Services\Traits;

trait FileServiceTrait
{
    /**
     * fileService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Services\FileService
     */
    protected $fileService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Services\FileService $fileService
     */
    public function injectFileService(\Datamints\DatamintsLocallangBuilder\Services\FileService $fileService)
    {
        $this->fileService = $fileService;
    }
}
