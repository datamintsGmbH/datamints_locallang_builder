<?php

namespace Datamints\DatamintsLocallangBuilder\Services\Traits;

trait BackupServiceTrait
{
    /**
     * backupService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Services\BackupService
     */
    protected $backupService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Services\BackupService $backupService
     */
    public function injectBackupService(\Datamints\DatamintsLocallangBuilder\Services\BackupService $backupService)
    {
        $this->backupService = $backupService;
    }
}
