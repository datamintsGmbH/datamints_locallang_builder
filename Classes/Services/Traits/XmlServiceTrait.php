<?php

namespace Datamints\DatamintsLocallangBuilder\Services\Traits;

trait XmlServiceTrait
{
    /**
     * xmlService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Services\XmlService
     */
    protected $xmlService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Services\XmlService $xmlService
     */
    public function injectXmlService(\Datamints\DatamintsLocallangBuilder\Services\XmlService $xmlService)
    {
        $this->xmlService = $xmlService;
    }
}
