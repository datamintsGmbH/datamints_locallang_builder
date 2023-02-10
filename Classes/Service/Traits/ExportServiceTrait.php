<?php

namespace Datamints\DatamintsLocallangBuilder\Service\Traits;

trait ExportServiceTrait
{
    /**
     * exportService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Service\ExportService
     */
    protected $exportService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Service\ExportService $exportService
     */
    public function injectExportService(\Datamints\DatamintsLocallangBuilder\Service\ExportService $exportService)
    {
        $this->exportService = $exportService;
    }
}
