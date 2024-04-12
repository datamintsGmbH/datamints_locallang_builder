<?php

namespace Datamints\DatamintsLocallangBuilder\Service\Traits;

trait BackupServiceTrait
{
    /**
     * backupService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Service\BackupService
     */
    protected $backupService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Service\BackupService $backupService
     */
    public function injectBackupService(\Datamints\DatamintsLocallangBuilder\Service\BackupService $backupService)
    {
        $this->backupService = $backupService;
    }
}
