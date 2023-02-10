<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Service;

use Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang;
use Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue;

class LocallangService extends AbstractService
{

    /**
     * Provides a list of all given country codes as array e.g. ['en','de']
     *
     * @param TranslationValue $translationValue
     * @param string           $text
     *
     * @return array
     */
    public function getCountryList(Locallang $locallang): array
    {
        $countries = [];

        foreach ($locallang->getTranslations() as $translation) {
            foreach ($translation->getTranslationValues() as $translationValue) {
                if(!in_array($translationValue->getIdent(), $countries)) {
                    $countries[] = $translationValue->getIdent();
                }
            }
        }

        return $countries;
    }

    /**
     * Provides the full filename for a country. The defined default-language has to ignore the prefix "en.locallang.***"
     *
     * Currently the default-value is always "en", but maybe i'll add a option to change this, when requested.
     *
     * e.g.
     * locallang.xlf (default)
     * de.locallang.xlf
     *
     */
    public function getCountryFilenameByLocallang(string $country, Locallang $locallang): string
    {
        if($country === 'en')
            return $locallang->getPath();
    }
}
