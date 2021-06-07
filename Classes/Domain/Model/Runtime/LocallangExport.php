<?php


namespace Datamints\DatamintsLocallangBuilder\Domain\Model\Runtime;


/**
 * Class LocallangExport
 *
 * Helper-Class-Model
 *
 */
class LocallangExport
{
    /**
     * @var string
     */
    protected $targetPath;

    /**
     * @var string
     */
    protected $languageCode;

    /**
     * @var \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang
     */
    protected $locallangReference;

    /**
     * Get the value of targetPath
     *
     * @return  string
     */
    public function getTargetPath()
    {
        return $this->targetPath;
    }

    /**
     * Set the value of targetPath
     *
     * @param  string  $targetPath
     *
     * @return  self
     */
    public function setTargetPath(string $targetPath)
    {
        $this->targetPath = $targetPath;

        return $this;
    }

    /**
     * Get the value of languageCode
     *
     * @return  string
     */
    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    /**
     * Set the value of languageCode
     *
     * @param  string  $languageCode
     *
     * @return  self
     */
    public function setLanguageCode(string $languageCode)
    {
        $this->languageCode = $languageCode;

        return $this;
    }

    /**
     * Get the value of locallangReference
     *
     * @return  \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang
     */
    public function getLocallangReference()
    {
        return $this->locallangReference;
    }

    /**
     * Set the value of locallangReference
     *
     * @param  \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang  $locallangReference
     *
     * @return  self
     */
    public function setLocallangReference(\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallangReference)
    {
        $this->locallangReference = $locallangReference;

        return $this;
    }
}
