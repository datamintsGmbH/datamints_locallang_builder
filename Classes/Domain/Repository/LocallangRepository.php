<?php

namespace Datamints\DatamintsLocallangBuilder\Domain\Repository;

use Datamints\DatamintsLocallangBuilder\Domain\Model\Constraint;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Extension;

/**
 * This file is part of the "datamints_locallang_builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * The repository for Locallangs
 */
class LocallangRepository extends AbstractRepository
{

	protected $modelTableName = 'tx_datamintslocallangbuilder_domain_model_locallang';

	/**
	 * @var array
	 */
	protected $defaultOrderings = ['sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];

	/**
	 * Findet Benutzer anhand seiner Benutzergruppe und wenn der First-Login Timestamp unter einem gewissen Wert ist
	 *
	 * @param Extension $extension
	 * @param string    $path
	 *
	 * @return array|object|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
	 */
	public function findByExtensionAndPath(Extension $extension, string $path)
	{
		return $this->findGenericByConstraints(
			[
				new Constraint(\TYPO3\CMS\Extbase\Persistence\QueryInterface::OPERATOR_EQUAL_TO, 'relatedExtension', $extension->getUid()),
				new Constraint(\TYPO3\CMS\Extbase\Persistence\QueryInterface::OPERATOR_EQUAL_TO, 'path', $path),
			]
        );
    }
}
