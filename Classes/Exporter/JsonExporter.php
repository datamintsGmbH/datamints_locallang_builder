<?php

namespace Datamints\DatamintsLocallangBuilder\Exporter;

use Datamints\DatamintsLocallangBuilder\Domain\Model\Translation;
use Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Runtime\LocallangExport;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Exception;

class JsonExporter extends AbstractExporter
{
    public function writeByLocallangExport(LocallangExport $locallangExport): string
    {
        $translations = [];

        /** @var Translation $translation */
        foreach ($locallangExport->getLocallangReference()->getTranslations() as $translation) {
            /** @var TranslationValue $translationValue */
            foreach ($translation->getTranslationValues() as $translationValue) {
                if ($translationValue->getIdent() === $locallangExport->getLanguageCode()) {
                    $translations[$translation->getTranslationKey()] = $translationValue->getValue();
                }
            }
        }

        $absoluteTargetPath = GeneralUtility::getFileAbsFileName($locallangExport->getTargetPath());
        GeneralUtility::mkdir_deep(\pathinfo($absoluteTargetPath, PATHINFO_DIRNAME));
        $jsonContent = \json_encode(
            $translations,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
        );
        if (\file_put_contents($absoluteTargetPath, $jsonContent . PHP_EOL) === false) {
            throw new Exception('The locallang JSON export could not be written to ' . $locallangExport->getTargetPath());
        }

        return $locallangExport->getTargetPath();
    }
}
