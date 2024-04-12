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

    /**
     * Prepares the locallang-export-output and saves the file
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Runtime\LocallangExport $locallangExport
     *
     * @return string
     * {@inheritdoc}
     */
    public function writeByLocallangExport (\Datamints\DatamintsLocallangBuilder\Domain\Model\Runtime\LocallangExport $locallangExport): string
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        // Nodes
        $xliffNode = $this->createXliffNode($dom);
        $fileNode = $this->createFileNode($dom, $locallangExport);
        $headerNode = $this->createHeaderNode($dom);
        $commentNode = $this->createComment($dom, 'This translation file was generated automatically by the "datamints_locallang_builder" extension. Please note that changes to this file can be lost the next time someone triggers an export in the TYPO3 Backend-module');
        $bodyNode = $this->createBodyNode($dom);

        $headerNode->appendChild($commentNode);
        $fileNode->appendChild($headerNode);

        /** @var Translation $translation */
        foreach ($locallangExport->getLocallangReference()->getTranslations() as $translation) {
            /** @var TranslationValue $translationValue */
            foreach ($translation->getTranslationValues() as $translationValue) { // Buggy when using getTranslationValues() as ObjectStorage. I absolutely dont know why it iterates the same value twice. So we better loop it as array and everything works...
                if ($translationValue->getIdent() === $locallangExport->getLanguageCode()) { // Filter to get our desired language and skip everything else
                    $transUnitNode = $this->createTransUnitNode($dom, $translation, $translationValue->getResname());
                    $transUnitCommentNode = $sourceNode = $targetNode = null;
                    $comment = ($translation->getDefaultTranslationValue() ? $translation->getDefaultTranslationValue()->getComment() : '');
                    if (strlen($comment) > 0) {
                        $transUnitCommentNode = $this->createComment($dom, $comment);
                        $transUnitNode->appendChild($transUnitCommentNode); // it would be nice to have it a line above the <trans-unit> but if we do so, we can't reimport the comment anymore, because its out of scope.
                    }

                    // Checking some optional flags
                    $transUnitNode->setAttribute('approved', ($translationValue->isApproved()) ? 'yes' : 'no');
                    if ($translationValue->getXmlSpace()) {
                        $transUnitNode->setAttribute('xml:space', $translationValue->getXmlSpace());
                    }

                    // Condition when the file only contains the default-language
                    if ($locallangExport->getLanguageCode() === 'en') { // in this case we only need "source"-Node when the output file language code is en
                        $sourceNode = $this->createSourceNode($dom, $translationValue);
                    } else { // Condition when the file contains an translation. Then we need source & target
                        $sourceNode = $this->createSourceNode($dom, $translation->getDefaultTranslationValue());
                        $targetNode = $this->createTargetNode($dom, $translationValue);
                    }
                    $transUnitNode->appendChild($sourceNode);
                    if ($targetNode) {
                        $transUnitNode->appendChild($targetNode);
                    }

                    $bodyNode->appendChild($transUnitNode);
                }
            }
        }

        $fileNode->appendChild($bodyNode);
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
    protected function createXliffNode (DOMDocument $dom): DOMElement
    {
        $xliffNode = $dom->createElement('xliff');
        $xliffNode->setAttribute('version', '1.0');

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
    protected function createFileNode (DOMDocument $dom, \Datamints\DatamintsLocallangBuilder\Domain\Model\Runtime\LocallangExport $locallangExport): DOMElement
    {
        $readableDateTime = new \DateTime();
        $originalPath = pathinfo($locallangExport->getLocallangReference()->getRelatedExtension()->getName() . '/' . ManifestBuildService::EXTENSION_LANGUAGE_PATH . $locallangExport->getLocallangReference()->getFilename());

        $fileNode = $dom->createElement('file');
        $fileNode->setAttribute('source-language', 'en'); // its ok to hardcode this, because depending on the the typo3 rules, it has to be 'en'. On request i can add an configuration-option to swap the default-language when an extension has invalid locallang-files.
        $fileNode->setAttribute('datatype', 'plaintext');
        $fileNode->setAttribute('original', 'EXT:' . $originalPath['dirname'] . '/' . $originalPath['filename']); // Don't use the full path because its different to what we need! So we build this one up in a different way
        $fileNode->setAttribute('date', $readableDateTime->format('Y-m-dH:i:s') . 'Z'); // whats the Z for?
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
        $sourceNode = $dom->createElement('source', ($translationValue) ? htmlspecialchars($translationValue->getValue()) : 'no default value found');

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
        $targetNode = $dom->createElement('target', htmlspecialchars($translationValue->getValue()));

        return $targetNode;
    }
}
