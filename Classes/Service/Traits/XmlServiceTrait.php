<?php

namespace Datamints\DatamintsLocallangBuilder\Service\Traits;

trait XmlServiceTrait
{
    /**
     * xmlService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Service\XmlService
     */
    protected $xmlService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Service\XmlService $xmlService
     */
    public function injectXmlService(\Datamints\DatamintsLocallangBuilder\Service\XmlService $xmlService)
    {
        $this->xmlService = $xmlService;
    }
}
