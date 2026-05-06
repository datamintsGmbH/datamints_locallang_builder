<?php


namespace Datamints\DatamintsLocallangBuilder\Exporter;

/* * *************************************************************
 * This file is part of the "locallang builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * ************************************************************* */

use DOMComment;
use Exception;
use DOMElement;
use DOMDocument;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Runtime\LocallangExport;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Extension;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Translation;
use Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue;
use Datamints\DatamintsLocallangBuilder\Service\ManifestBuildService;
use Datamints\DatamintsLocallangBuilder\Service\Traits\XmlServiceTrait;

class XmlExporter extends AbstractExporter
{
    use XmlServiceTrait;

    public const XLIFF_VERSION_12 = '1.2';
    public const XLIFF_VERSION_20 = '2.0';
    private const AUTO_GENERATED_COMMENT = 'This translation file was generated automatically by the "datamints_locallang_builder" extension. Please note that changes to this file can be lost the next time someone triggers an export in the TYPO3 Backend-module';

    /**
     * Prepares the locallang-export-output and saves the file
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Runtime\LocallangExport $locallangExport
     *
     * @return string
     * {@inheritdoc}
     */
    public function writeByLocallangExport (LocallangExport $locallangExport): string
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $isXliff20 = $this->isXliff20($locallangExport);
        // Nodes
        $xliffNode = $this->createXliffNode($dom, $locallangExport);
        $fileNode = $this->createFileNode($dom, $locallangExport);
        $bodyNode = null;

        if ($isXliff20) {
            $fileNode->appendChild($this->createNotesNode($dom, self::AUTO_GENERATED_COMMENT));
        } else {
            $headerNode = $this->createHeaderNode($dom);
            $commentNode = $this->createComment($dom, self::AUTO_GENERATED_COMMENT);
            $bodyNode = $this->createBodyNode($dom);
            $headerNode->appendChild($commentNode);
            $fileNode->appendChild($headerNode);
        }

        /** @var Translation $translation */
        foreach ($locallangExport->getLocallangReference()->getTranslations() as $translation) {
            /** @var TranslationValue $translationValue */
            foreach ($translation->getTranslationValues() as $translationValue) { // Buggy when using getTranslationValues() as ObjectStorage. I absolutely dont know why it iterates the same value twice. So we better loop it as array and everything works...
                if ($translationValue->getIdent() === $locallangExport->getLanguageCode()) { // Filter to get our desired language and skip everything else
                    $translationNode = $this->createTranslationNode($dom, $translation, $translationValue->getResname(), $locallangExport);
                    $sourceNode = $targetNode = null;
                    $comment = ($translation->getDefaultTranslationValue() ? $translation->getDefaultTranslationValue()->getComment() : '');
                    if (strlen($comment) > 0) {
                        if ($isXliff20) {
                            $translationNode->appendChild($this->createNotesNode($dom, $comment));
                        } else {
                            $translationNode->appendChild($this->createComment($dom, $comment)); // it would be nice to have it a line above the <trans-unit> but if we do so, we can't reimport the comment anymore, because its out of scope.
                        }
                    }

                    // Checking some optional flags
                    if (!$isXliff20) {
                        $translationNode->setAttribute('approved', ($translationValue->isApproved()) ? 'yes' : 'no');
                    }
                    if (!$isXliff20 && $translationValue->getXmlSpace()) {
                        $translationNode->setAttribute('xml:space', $translationValue->getXmlSpace());
                    }

                    // Condition when the file only contains the default-language
                    if ($locallangExport->getLanguageCode() === 'en') { // in this case we only need "source"-Node when the output file language code is en
                        $sourceNode = $this->createSourceNode($dom, $translationValue);
                        $this->applyXmlSpace($sourceNode, $translationValue, $isXliff20);
                    } else { // Condition when the file contains an translation. Then we need source & target
                        $sourceNode = $this->createSourceNode($dom, $translation->getDefaultTranslationValue());
                        $targetNode = $this->createTargetNode($dom, $translationValue);
                        $this->applyXmlSpace($sourceNode, $translation->getDefaultTranslationValue(), $isXliff20);
                        $this->applyXmlSpace($targetNode, $translationValue, $isXliff20);
                        if ($isXliff20) {
                            $this->applyXliff20State($targetNode, $translationValue);
                        }
                    }

                    if ($isXliff20) {
                        $segmentNode = $this->createSegmentNode($dom, $translation);
                        $segmentNode->appendChild($sourceNode);
                        if ($targetNode) {
                            $segmentNode->appendChild($targetNode);
                        }
                        $translationNode->appendChild($segmentNode);
                        $fileNode->appendChild($translationNode);
                    } else {
                        $translationNode->appendChild($sourceNode);
                        if ($targetNode) {
                            $translationNode->appendChild($targetNode);
                        }
                        $bodyNode->appendChild($translationNode);
                    }
                }
            }
        }

        if ($bodyNode instanceof DOMElement) {
            $fileNode->appendChild($bodyNode);
        }
        $xliffNode->appendChild($fileNode);

        $dom->appendChild($xliffNode);
        // DebuggerUtility::var_dump(pathinfo($locallangExport->getTargetPath())['dirname']);
        // die();
        GeneralUtility::mkdir_deep(GeneralUtility::getFileAbsFileName(pathinfo($locallangExport->getTargetPath())['dirname']));
        $dom->save(GeneralUtility::getFileAbsFileName($locallangExport->getTargetPath()));

        // PostProcessing for cdata-nodes to make them working properly again (its encoded as e.g. &lt; otherwise)
        // So what to do now? We open the file again and decode html entities
        // TODO - I hope someone has a better idea, because saving the file twice is pretty ugly!
//        $file = file_get_contents(GeneralUtility::getFileAbsFileName($locallangExport->getTargetPath()));
//        $file = \html_entity_decode($file, ENT_NOQUOTES);
//        file_put_contents(GeneralUtility::getFileAbsFileName($locallangExport->getTargetPath()), $file);

        return $locallangExport->getTargetPath();
    }

    /**
     * Creates xliff-node
     *
     * @param DOMDocument $dom
     *
     * @return DOMElement
     */
    protected function createXliffNode (DOMDocument $dom, LocallangExport $locallangExport): DOMElement
    {
        if ($this->isXliff20($locallangExport)) {
            $xliffNode = $dom->createElementNS('urn:oasis:names:tc:xliff:document:2.0', 'xliff');
            $xliffNode->setAttribute('version', self::XLIFF_VERSION_20);
            $xliffNode->setAttribute('srcLang', 'en');
            if ($locallangExport->getLanguageCode() !== 'en') {
                $xliffNode->setAttribute('trgLang', $locallangExport->getLanguageCode());
            }

            return $xliffNode;
        }

        $xliffNode = $dom->createElementNS('urn:oasis:names:tc:xliff:document:1.2', 'xliff');
        $xliffNode->setAttribute('version', self::XLIFF_VERSION_12);

        return $xliffNode;
    }

    /**
     * Creates file-node
     *
     * @param DOMDocument                                                       $dom
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\LocallangExport $locallangExport
     *
     * @return DOMElement
     */
    protected function createFileNode (DOMDocument $dom, LocallangExport $locallangExport): DOMElement
    {
        $readableDateTime = new \DateTime();
        $originalPath = pathinfo($locallangExport->getLocallangReference()->getRelatedExtension()->getName() . '/' . ManifestBuildService::EXTENSION_LANGUAGE_PATH . $locallangExport->getLocallangReference()->getFilename());

        $fileNode = $dom->createElement('file');
        if ($this->isXliff20($locallangExport)) {
            $fileNode->setAttribute('id', 'EXT:' . $originalPath['dirname'] . '/' . $originalPath['filename']);
            $fileNode->setAttribute('original', 'EXT:' . $originalPath['dirname'] . '/' . $originalPath['filename']);
            return $fileNode;
        }

        $fileNode->setAttribute('source-language', 'en'); // its ok to hardcode this, because depending on the the typo3 rules, it has to be 'en'. On request i can add an configuration-option to swap the default-language when an extension has invalid locallang-files.
        $fileNode->setAttribute('datatype', 'plaintext');
        $fileNode->setAttribute('original', 'EXT:' . $originalPath['dirname'] . '/' . $originalPath['filename']); // Don't use the full path because its different to what we need! So we build this one up in a different way
        $fileNode->setAttribute('date', $readableDateTime->format('Y-m-d\TH:i:s\Z'));
        $fileNode->setAttribute('product-name', $locallangExport->getLocallangReference()->getRelatedExtension()->getName());
        if ($locallangExport->getLanguageCode() !== 'en') {
            $fileNode->setAttribute('target-language', $locallangExport->getLanguageCode());
        }

        return $fileNode;
    }

    /**
     * Creates header-node
     * Its empty always
     *
     * @param DOMDocument $dom
     *
     * @return DOMElement
     */
    protected function createHeaderNode (DOMDocument $dom): DOMElement
    {
        $headerNode = $dom->createElement('header');


        return $headerNode;
    }

    /**
     * Creates comment
     *
     * @param DOMDocument $dom
     * @param string      $comment
     *
     * @return DOMComment
     */
    protected function createComment (DOMDocument $dom, string $comment): DOMComment
    {
        $commentNode = $dom->createComment($comment);

        return $commentNode;
    }

    /**
     * Creates body-node containing all translations
     *
     * @param DOMDocument $dom
     *
     * @return DOMElement
     */
    protected function createBodyNode (DOMDocument $dom): DOMElement
    {
        $bodyNode = $dom->createElement('body');


        return $bodyNode;
    }

    protected function createSegmentNode(DOMDocument $dom, Translation $translation): DOMElement
    {
        $segmentNode = $dom->createElement('segment');
        $segmentNode->setAttribute('id', $translation->getTranslationKey());

        return $segmentNode;
    }

    /**
     * Creates trans-unit-node containing one translation
     *
     * @param DOMDocument                                                   $dom
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation
     * @param string                                                        $resname
     *
     * @return DOMElement
     */
    protected function createTransUnitNode (DOMDocument $dom, Translation $translation, string $resname): DOMElement
    {
        $transUnitNode = $dom->createElement('trans-unit');
        $transUnitNode->setAttribute('id', $translation->getTranslationKey());
        if (strlen($resname) === 0) { // if there is no res-name defined, we will use the translationKey as resname
            $resname = $translation->getTranslationKey();
        }
        $transUnitNode->setAttribute('resname', $resname); // im not sure if its necessary to handle this as possible different to the translation. It seems to be the same.

        return $transUnitNode;
    }

    protected function createUnitNode(DOMDocument $dom, Translation $translation, string $resname): DOMElement
    {
        $unitNode = $dom->createElement('unit');
        $unitNode->setAttribute('id', $translation->getTranslationKey());
        if (strlen($resname) === 0) {
            $resname = $translation->getTranslationKey();
        }
        $unitNode->setAttribute('name', $resname);

        return $unitNode;
    }

    protected function createTranslationNode(DOMDocument $dom, Translation $translation, string $resname, LocallangExport $locallangExport): DOMElement
    {
        return $this->isXliff20($locallangExport)
            ? $this->createUnitNode($dom, $translation, $resname)
            : $this->createTransUnitNode($dom, $translation, $resname);
    }

    /**
     * Creates source-node for a translation
     *
     * @param DOMDocument                                                        $dom
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue
     *
     * @return DOMElement
     */
    protected function createSourceNode (DOMDocument $dom, ?TranslationValue $translationValue): DOMElement
    {
        $sourceNode = $dom->createElement('source', ($translationValue) ? htmlspecialchars($translationValue->getValue(), ENT_QUOTES) : 'no default value found');

        return $sourceNode;
    }

    /**
     * Creates target-node for a translation
     *
     * @param DOMDocument                                                        $dom
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue
     *
     * @return DOMElement
     */
    protected function createTargetNode (DOMDocument $dom, TranslationValue $translationValue): DOMElement
    {
        $targetNode = $dom->createElement('target', htmlspecialchars($translationValue->getValue(), ENT_QUOTES));

        return $targetNode;
    }

    protected function createNotesNode(DOMDocument $dom, string $comment): DOMElement
    {
        $notesNode = $dom->createElement('notes');
        $noteNode = $dom->createElement('note', htmlspecialchars($comment, ENT_QUOTES));
        $notesNode->appendChild($noteNode);

        return $notesNode;
    }

    protected function applyXmlSpace(DOMElement $node, ?TranslationValue $translationValue, bool $isXliff20): void
    {
        if ($isXliff20 && $translationValue instanceof TranslationValue && $translationValue->getXmlSpace()) {
            $node->setAttribute('xml:space', $translationValue->getXmlSpace());
        }
    }

    protected function applyXliff20State(DOMElement $targetNode, TranslationValue $translationValue): void
    {
        $targetNode->setAttribute('state', $translationValue->isApproved() ? 'final' : 'initial');
    }

    protected function isXliff20(LocallangExport $locallangExport): bool
    {
        return $locallangExport->getXliffVersion() === self::XLIFF_VERSION_20;
    }
}
