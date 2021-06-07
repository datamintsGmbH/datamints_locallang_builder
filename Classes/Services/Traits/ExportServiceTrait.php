<?php

namespace Datamints\DatamintsLocallangBuilder\Services\Traits;

trait ExportServiceTrait
{
    /**
     * exportService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Services\ExportService
     */
    protected $exportService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Services\ExportService $exportService
     */
    public function injectExportService(\Datamints\DatamintsLocallangBuilder\Services\ExportService $exportService)
    {
        $this->exportService = $exportService;
    }
}
