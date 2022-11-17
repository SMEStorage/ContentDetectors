<?php
namespace SME\ContentDetectors\Detectors\Canada;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;
use SME\ContentDetectors\Validators\Luhn as LuhnAlgorithm;


/**
 * Class SocialInsuranceNumber
 *
 * Detector implementation for Canadian Social Insurance Numbers
 * https://en.wikipedia.org/wiki/Social_Insurance_Number
 *
 * @package SME\ContentDetectors\Detectors\Canada
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class SocialInsuranceNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'caSin';
    
    protected $_validator = null;
    
    
    protected function getValidator() {
        if (! $this->_validator) {
            $this->_validator = new LuhnAlgorithm();
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
        return '/\b(\d{3}[ -]?\d{3}[ -]?\d{3})\b/um';
    }
    
    
    /**
     * Validate Canadian Social Insurance Number by checksum
     * https://en.wikipedia.org/wiki/Social_Insurance_Number#Validation
     *
     * @param string
     * @return bool
     */
     
    protected function validate($match)
    {
         // remove anything other than digits
        $sin = preg_replace("/[^\d]/u", "", $match);
         
        // length check
        if (strlen($sin) != 9) {
            return false;
        }
         
        return ($this->getValidator()->calculate($sin) == 0) ? true : false;
    }
   
}
