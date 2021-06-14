<?php

namespace Datamints\DatamintsLocallangBuilder\Domain\Repository;


/**
 * This file is part of the "locallang builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * The repository for TranslationValues
 */
class TranslationValueRepository extends AbstractRepository
{

	protected $modelTableName = 'tx_datamintslocallangbuilder_domain_model_translationvalue';

	/**
	 * @var array
	 */
	protected $defaultOrderings = ['sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];
}
