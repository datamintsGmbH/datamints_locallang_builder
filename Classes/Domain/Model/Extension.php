<?php

namespace Datamints\DatamintsLocallangBuilder\Domain\Model;

use JsonSerializable;

/**
 * This file is part of the "locallang-xlf" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * Extension
 */
class Extension extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity implements JsonSerializable
{

	/**
	 * Extension Name
	 *
	 * @var string
	 * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
	 */
	protected $name = '';

	/**
	 * Path to the extension-folder from content root
	 *
	 * @var string
	 * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
	 */
	protected $path = '';

	/**
	 * local
	 *
	 * @var bool
	 * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
	 */
	protected $local = false;

	/**
	 * locallangs
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
	 */
	protected $locallangs = null;

	/**
	 * __construct
	 */
	public function __construct()
	{

		// Do not remove the next line: It would break the functionality
		$this->initializeObject();
	}

	/**
	 * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	public function initializeObject()
	{
		$this->locallangs = $this->locallangs ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the path
	 *
	 * @return string path
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * Sets the path
	 *
	 * @param string $path
	 *
	 * @return void
	 */
	public function setPath($path)
	{
		$this->path = $path;
	}

	/**
	 * Adds a Locallang
	 *
	 * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
	 *
	 * @return void
	 */
	public function addLocallang(\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang)
	{
		$this->locallangs->attach($locallang);
	}

	/**
	 * Removes a Locallang
	 *
	 * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallangToRemove The Locallang to be removed
	 *
	 * @return void
	 */
	public function removeLocallang(\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallangToRemove)
	{
		$this->locallangs->detach($locallangToRemove);
	}

	/**
	 * Returns the local
	 *
	 * @return bool $local
	 */
	public function getLocal()
	{
		return $this->local;
	}

	/**
	 * Returns the boolean state of local
	 *
	 * @return bool
	 */
	public function isLocal()
	{
		return $this->local;
	}

	/**
	 * Sets the local
	 *
	 * @param bool $local
	 *
	 * @return void
	 */
	public function setLocal($local)
	{
		$this->local = $local;
	}

	/**
	 * Filtering json-output, if needed
	 * To output all files, use return get_object_vars($this);
	 */
	public function jsonSerialize()
	{
		return [
			'uid' => $this->getUid(),
			'name' => $this->getName(),
			'local' => $this->isLocal(),
			'locallangs' => $this->getLocallangs()->toArray()
        ];
    }

	/**
	 * Returns the name
	 *
	 * @return string name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 *
	 * @return void
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * Returns the locallangs
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang> locallangs
	 */
	public function getLocallangs()
	{
		return $this->locallangs;
	}

	/**
	 * Sets the locallangs
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang> $locallangs
	 *
	 * @return void
	 */
	public function setLocallangs(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $locallangs)
	{
		$this->locallangs = $locallangs;
	}
}
