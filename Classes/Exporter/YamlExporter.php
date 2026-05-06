<?php

namespace Datamints\DatamintsLocallangBuilder\Exporter;

use Datamints\DatamintsLocallangBuilder\Domain\Model\Runtime\LocallangExport;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Translation;
use Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue;
use Symfony\Component\Yaml\Yaml;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class YamlExporter extends AbstractExporter
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
        $yamlContent = Yaml::dump($translations, 10, 2, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);
        if (\file_put_contents($absoluteTargetPath, $yamlContent . PHP_EOL) === false) {
            throw new Exception('The locallang YAML export could not be written to ' . $locallangExport->getTargetPath());
        }

        return $locallangExport->getTargetPath();
    }
}
