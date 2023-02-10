<?php


namespace Datamints\DatamintsLocallangBuilder\Exporter;

/* * *************************************************************
 * This file is part of the "locallang builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * ************************************************************* */

use Datamints\DatamintsLocallangBuilder\Service\AbstractService;


abstract class AbstractExporter extends AbstractService
{

	/**
	 * Writes output for an given locallang-entity
	 *
	 * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Runtime\LocallangExport $locallangExport
	 *
	 * @return string
	 */
	abstract public function writeByLocallangExport(\Datamints\DatamintsLocallangBuilder\Domain\Model\Runtime\LocallangExport $locallangExport): string;
}
