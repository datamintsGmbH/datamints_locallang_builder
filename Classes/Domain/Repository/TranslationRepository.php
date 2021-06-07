<?php

namespace Datamints\DatamintsLocallangBuilder\Domain\Repository;


/**
 * This file is part of the "locallang-xlf" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de>
 * The repository for Translations
 */
class TranslationRepository extends AbstractRepository
{

    protected $modelTableName = 'tx_locallangbuilder_domain_model_translation';

    /**
     * @var array
     */
    protected $defaultOrderings = ['sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];
}
