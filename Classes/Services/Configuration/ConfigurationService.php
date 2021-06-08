<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Services\Configuration;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

class ConfigurationService implements SingletonInterface
{
	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 */
	protected $configurationManager;

	/**
	 * @var \TYPO3\CMS\Core\Configuration\ExtensionConfiguration
	 */
	protected $extensionConfiguration;

	public function __construct(ConfigurationManagerInterface $configurationManager, ExtensionConfiguration $extensionConfiguration)
	{
		$this->configurationManager = $configurationManager;
		$this->extensionConfiguration = $extensionConfiguration;
	}

	/**
	 * @param string|null $pluginName
	 *
	 * @return array
	 */
	public function getSettings($pluginName = null)
	{
		return $this->configurationManager->getConfiguration(
			ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
			'LocallangBuilder',
			$pluginName
		);
	}

	/**
	 * @param string|null $pluginName
	 *
	 * @return array
	 */
	public function getFrameworkConfiguration($pluginName = null)
	{
		return $this->configurationManager->getConfiguration(
			ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK,
			'LocallangBuilder',
			$pluginName
		);
	}

	/**
	 * @return ConfigurationManagerInterface
	 */
	public function getConfigurationManager()
	{
		return $this->configurationManager;
	}

	/**
	 * @return array
	 */
	public function getExtensionConfiguration()
	{
		return $this->extensionConfiguration->get('datamints_locallang_builder');
    }
}
