<?php
namespace SME\ContentDetectors\Detectors\Bank;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;
use \IBAN as IbanAccountNumberValidator;

/**
 * Class IbanAccountNumber
 *
 * Detector implementation for IBAN Account Numbers
 *
 * @package SME\ContentDetectors\Detectors\Bank
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class IbanAccountNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'bankIban';
    
    /**
     * validator
     * @var IbanAccountNumberValidator
     */
    
    protected $_validator = null;
    
    
    protected function getValidator() {
        if (! $this->_validator) {
            $this->_validator = new IbanAccountNumberValidator();
        }
        
        return $this->_validator;
    }
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([a-zA-Z]{2}[0-9]{2}[ -]?([a-zA-Z0-9]{4}[ -]?){3,6}[a-zA-Z0-9]{0,4})\b/uim';
    }

    /**
     * Validate IBAN Account Numbers
     * 
     * @param string
     * @return bool
     */
     
    protected function validate($match)
    {
        $valid = $this->getValidator()->Verify(preg_replace("/[^\dA-Z]/ui", "", $match));
        
        return $valid ? true : false;
    }
    
    
}