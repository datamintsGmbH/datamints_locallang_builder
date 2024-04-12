<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Service;

use DOMElement;
use DOMNodeList;
use Exception;
use Symfony\Component\Config\Util\XmlUtils;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Translation;
use Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue;

class XmlService extends AbstractService
{


    /**
     * Assign XML-Stuff to TranslationValue-Model
     *
     * @param DOMElement  $domElement
     * @param Translation $translation
     *
     * @return TranslationValue
     */
    public function getTranslationValuePart (DOMElement $domElement): TranslationValue
    {
        /** @var TranslationValue $translationValue */
        $translationValue = GeneralUtility::makeInstance(TranslationValue::class);
        // Check if theres a target-tag, otherwise we expect it coming from the source-tag. The Target-Tag is more important, because default-translations (locallang.xlf) should only contain "source"-Tags
        if (count($domElement->getElementsByTagName('target'))) {
            $targetValue = '';
            $targetNode = $domElement->getElementsByTagName('target')[0];
            foreach ($targetNode->childNodes as $child) {
                if ($child->nodeType == XML_CDATA_SECTION_NODE) {
                    $targetValue .= $this->wrapCData($child->textContent);
                } else {
                    $targetValue .= $child->textContent;
                }
            }
            $translationValue->setValue($targetValue);
        } else {
            $sourceValue = '';
            $sourceNode = $domElement->getElementsByTagName('source')[0];
            foreach ($sourceNode->childNodes as $child) {
                if ($child->nodeType == XML_CDATA_SECTION_NODE) {
                    $sourceValue .= $this->wrapCData($child->textContent);
                } else {
                    $sourceValue .= $child->textContent;
                }
            }
            $translationValue->setValue($sourceValue);
        }
        if ($domElement->hasAttribute('xml:space')) {
            $translationValue->setXmlSpace($domElement->getAttribute('xml:space'));
        }

        // https://github.com/datamintsGmbH/datamints_locallang_builder/issues/3 Added check if the value equals 'yes' because its also possible to contain 'no' OR leaves blank
        if ($domElement->hasAttribute('approved') && $domElement->getAttribute('approved') == 'yes') {
            $translationValue->setApproved(true); //default is false, so theres no need to specify this in the else condition
        }

        if ($domElement->hasAttribute('resname')) {
            $translationValue->setResname($domElement->getAttribute('resname'));
        }
        $comments = $this->getComment($domElement->ownerDocument->saveHTML($domElement));

        if (!is_null($comments)) {
            $translationValue->setComment($comments);
        }


        return $translationValue;
    }

    /**
     * Wraps text with a cdata-node (not as CDATASection https://www.php.net/manual/de/class.domcdatasection.php but as string)
     *
     * @param string $string
     *
     * @return string
     */
    protected function wrapCData (string $string): string
    {
        return '<![CDATA[' . $string . ']]>';
    }

    /**
     * Extracts html comments by regexp
     *
     * We're not using e.g. xpath because its not everywhere running
     *
     * @param $html
     *
     * @return array|null
     */
    protected function getComment ($html)
    {
        $rcomments = [];
        if (preg_match_all('#<\!--(.*?)-->#is', \htmlspecialchars_decode($html), $rcomments)) {
            return $comments = $rcomments[1][0];
        } else {
            // No comments matchs
            return null;
        }

    }

    /**
     * Finds related locallang files in the "Language"-Folder that belong to an extension
     *
     * @param string $path
     * @param string $tag
     *
     * @return DOMNodeList|DOMElement|null
     */
    public function getXMLContentByLocallang (string $path, string $tag)
    {
        try { // If the xml-File could not be fetches, we catch the exception and return null
            $xmlFile = XmlUtils::loadFile($path);
            $content = $xmlFile->getElementsByTagName($tag);
            if ($content->length == 1) {
                return $content[0];
            } else {
                return $content;
            }
        } catch (Exception $exception) {
            return null;
        }
    }
}
