<?php
/**
 * Validator Extend
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015/03/17          NgocNguyen
 */

namespace Helper\Services\Validation;

use Illuminate\Validation\Validator as IlluminateValidator;

class ValidatorExtended extends IlluminateValidator
{

    /**
     * Validate Message
     *
     * @var array
     */
    private $arrMessages = [
    ];

    /**
     * Named attribute name for validate
     *
     * @var array
     */
    private $arrAttributes = [
    ];

    public function __construct(\Symfony\Component\Translation\TranslatorInterface $translator, array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        parent::__construct($translator, $data, $rules, $messages, $customAttributes);
        $this->setCustomStuff();
    }

    /**
     * @author NgocNguyen
     * @name setCustomStuff
     * @todo Setup any customizations
     *
     * @access protected
     */
    protected function setCustomStuff()
    {
        // setup our custom error messages
        $this->setCustomMessages($this->arrMessages);
        $this->addCustomAttributes($this->arrAttributes);
    }

     /**
     * @author NgocNguyen
     * @name validateOneByte
     * @todo Check one-byte
     *
     * @param $attribute
     * @param $value
     *
     * @return bool
     * @access protected
     */
     protected function validateOneByte($attribute, $value)
     {
        return mb_strlen($value, 'UTF-8') == strlen($value);
    }

}