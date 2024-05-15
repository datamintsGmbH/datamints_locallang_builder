<?php
namespace Datamints\DatamintsLocallangBuilder\Domain\Model;


/**
 * This file is part of the "locallang builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * TranslationValue as its written in the xlf-File
 */
class TranslationValue extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity implements \JsonSerializable
{
    const IDENT_DEFAULT = 'en';

    /**
     * tstamp
     *
     * @var \DateTime
     */
    protected $tstamp = null;

    /**
     * new-flag to highlight in vue
     *
     * @var bool
     */
    protected $new = false;

    /**
     * Country Code or default-ident
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $ident = '';

    /**
     * Translation Value
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $value = '';

    /**
     * Optional
     *
     * @var string
     */
    protected $resname = '';

    /**
     * Options like "preserve"
     *
     * @var string
     */
    protected $xmlSpace = '';

    /**
     * Flag if the translation is approved
     *
     * @var bool
     */
    protected $approved = true;

    /**
     * Internal comment - rendered as html-comment in output-file
     *
     * @var string
     */
    protected $comment = '';

    /**
     * Returns the tstamp
     *
     * @return string $tstamp
     */
    public function getTstamp()
    {
        if($this->tstamp) {
            return $this->tstamp->format('Y-m-d H:i:s');
        }else{
            return '';
        }
    }

    /**
     * Sets the tstamp (it makes no sense, but we need to fake data sometimes to get the new current value after an update-action)
     *
     * @param \DateTime $tstamp
     * @return void
     */
    public function setTstamp(\DateTime $tstamp)
    {
        $this->tstamp = $tstamp;
    }

    /**
     * Returns the ident
     *
     * @return string $ident
     */
    public function getIdent()
    {
        return $this->ident;
    }

    /**
     * Sets the ident
     *
     * @param string $ident
     * @return void
     */
    public function setIdent($ident)
    {
        $this->ident = $ident;
    }

    /**
     * Returns the value
     *
     * @return string $value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value
     *
     * @param string $value
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Returns the resname
     *
     * @return string $resname
     */
    public function getResname()
    {
        return $this->resname;
    }

    /**
     * Sets the resname
     *
     * @param string $resname
     * @return void
     */
    public function setResname($resname)
    {
        $this->resname = $resname;
    }

    /**
     * Returns the xmlSpace
     *
     * @return string $xmlSpace
     */
    public function getXmlSpace()
    {
        return $this->xmlSpace;
    }

    /**
     * Sets the xmlSpace
     *
     * @param string $xmlSpace
     * @return void
     */
    public function setXmlSpace($xmlSpace)
    {
        $this->xmlSpace = $xmlSpace;
    }

    /**
     * Returns the approved
     *
     * @return bool $approved
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Returns the boolean state of approved
     *
     * @return bool
     */
    public function isApproved()
    {
        return $this->approved;
    }

    /**
     * Sets the approved
     *
     * @param bool $approved
     * @return void
     */
    public function setApproved(bool $approved)
    {
        $this->approved = $approved;
    }

    /**
     * Get new-flag to highlight in vue
     *
     * @return bool
     */
    public function getNew()
    {
        return $this->new;
    }

    /**
     * Set new-flag to highlight in vue
     *
     * @param bool $new new-flag to highlight in vue
     */
    public function setNew(bool $new)
    {
        $this->new = $new;
    }

    /**
     * Returns the comment
     *
     * @return string $comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Sets the comment
     *
     * @param string $comment
     * @return void
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Filtering json-output, if needed
     * To output all files, use return get_object_vars($this);
     */
    public function jsonSerialize():mixed
    {
        return [
            'uid' => $this->getUid(),
            'comment' => $this->getComment(),
            'new' => $this->getNew(),
            'approved' => $this->getApproved(),
            'ident' => $this->getIdent(),
            'xmlSpace' => $this->getXmlSpace(),
            'resname' => $this->getResname(),
            'tstamp' => $this->getTstamp(),
            'value' => $this->getValue()
        ];
    }


}
