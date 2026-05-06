<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Service;

use DOMDocument;
use DOMElement;
use DOMNodeList;
use DOMXPath;
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
        } elseif (count($domElement->getElementsByTagName('target')) && $domElement->getElementsByTagName('target')[0]->hasAttribute('xml:space')) {
            $translationValue->setXmlSpace($domElement->getElementsByTagName('target')[0]->getAttribute('xml:space'));
        } elseif (count($domElement->getElementsByTagName('source')) && $domElement->getElementsByTagName('source')[0]->hasAttribute('xml:space')) {
            $translationValue->setXmlSpace($domElement->getElementsByTagName('source')[0]->getAttribute('xml:space'));
        }

        // XLIFF 1.2 uses approved="yes", while XLIFF 2.0 expresses the workflow state on <target>.
        if ($domElement->hasAttribute('approved') && $domElement->getAttribute('approved') == 'yes') {
            $translationValue->setApproved(true); //default is false, so theres no need to specify this in the else condition
        } elseif (count($domElement->getElementsByTagName('target')) && $domElement->getElementsByTagName('target')[0]->getAttribute('state') === 'final') {
            $translationValue->setApproved(true);
        }

        if ($domElement->hasAttribute('resname')) {
            $translationValue->setResname($domElement->getAttribute('resname'));
        } elseif ($domElement->hasAttribute('name')) {
            $translationValue->setResname($domElement->getAttribute('name'));
        }
        $comments = $this->getComment($domElement);

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
        if ($html instanceof DOMElement) {
            $notes = $html->getElementsByTagName('note');
            if ($notes->length > 0) {
                $note = trim((string)$notes->item(0)?->textContent);
                if ($note !== '') {
                    return $note;
                }
            }

            $html = $html->ownerDocument->saveHTML($html);
        }

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
            $content = $this->queryByLocalNames($xmlFile, [$tag]);
            if ($content->length == 1) {
                return $content[0];
            } else {
                return $content;
            }
        } catch (Exception $exception) {
            return null;
        }
    }

    public function loadXmlDocument(string $path): ?DOMDocument
    {
        try {
            return XmlUtils::loadFile($path);
        } catch (Exception $exception) {
            return null;
        }
    }

    public function getFirstDomElementByTagNames(DOMDocument $xmlDocument, array $tagNames): ?DOMElement
    {
        $content = $this->queryByLocalNames($xmlDocument, $tagNames);
        if ($content->length === 0) {
            return null;
        }

        $firstElement = $content->item(0);

        return $firstElement instanceof DOMElement ? $firstElement : null;
    }

    public function getDomElementsByTagNames(DOMDocument $xmlDocument, array $tagNames): ?DOMNodeList
    {
        $content = $this->queryByLocalNames($xmlDocument, $tagNames);

        return $content->length > 0 ? $content : null;
    }

    public function getSourceLanguage(DOMDocument $xmlDocument, ?DOMElement $fileElement = null): string
    {
        $rootElement = $xmlDocument->documentElement;
        if ($rootElement instanceof DOMElement && $rootElement->hasAttribute('srcLang')) {
            return $rootElement->getAttribute('srcLang');
        }

        return $fileElement instanceof DOMElement && $fileElement->hasAttribute('source-language')
            ? $fileElement->getAttribute('source-language')
            : '';
    }

    public function getTargetLanguage(DOMDocument $xmlDocument, ?DOMElement $fileElement = null): string
    {
        $rootElement = $xmlDocument->documentElement;
        if ($rootElement instanceof DOMElement && $rootElement->hasAttribute('trgLang')) {
            return $rootElement->getAttribute('trgLang');
        }

        return $fileElement instanceof DOMElement && $fileElement->hasAttribute('target-language')
            ? $fileElement->getAttribute('target-language')
            : '';
    }

    protected function queryByLocalNames(DOMDocument $xmlDocument, array $tagNames): DOMNodeList
    {
        $xpath = new DOMXPath($xmlDocument);
        $conditions = array_map(
            static fn(string $tagName): string => sprintf('local-name()="%s"', $tagName),
            $tagNames
        );

        return $xpath->query('//*[' . implode(' or ', $conditions) . ']');
    }
}
