<?php
namespace SME\ContentDetectors\Detectors\Sweden;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;
use SME\ContentDetectors\Validators\Luhn as LuhnAlgorithm;


/**
 * Class NationalIdNumber
 *
 * Detector implementation for Swedish National ID Number - personnummer
 * https://en.wikipedia.org/wiki/Personal_identity_number_(Sweden)
  *
 * @package SME\ContentDetectors\Detectors\Sweden
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NationalIdNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'seNationalIdNumber';
    
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
        return '/\b((18|19|20)?\d{6}[\-+]?\d{4})\b/um';
    }
 
    /**
     * Validate Swedish National ID Number
     * https://en.wikipedia.org/wiki/Personal_identity_number_(Sweden)#Checksum
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
        // remove anything other than digits
        $nationalIdNumber = preg_replace("/[^\d]/u", "", $match);
       
        $numberLength = strlen($nationalIdNumber);
        // length check
        if (($numberLength != 12) && ($numberLength != 10)) {
            return false;
        }
        
        if ($this->validateNationalIdNumberDate($nationalIdNumber)) {
            if ($numberLength == 12) {
                $nationalIdNumber = substr($nationalIdNumber, -10);
            }
            
            return ($this->getValidator()->calculate($nationalIdNumber) == 0) ? true : false;
        }
        
        return false;
    }

    /**
     * Validate Swedish National ID Number date
     *
     * @param
     *            string
     * @return bool
     */
    private function validateNationalIdNumberDate($nationalIdNumber)
    {
        $year = '';
        $numberLength = strlen($nationalIdNumber);
        if ($numberLength == 12) {
            $year = substr($nationalIdNumber, 0, 4);
            $nationalIdNumber = substr($nationalIdNumber, - 10);
        } else {
            $year = substr($nationalIdNumber, 0, 2);
        }
        $month = intval(substr($nationalIdNumber, 2, 2));
        $day = intval(substr($nationalIdNumber, 4, 2));
        
        if (strlen($year) == 4) {
            if (checkdate($month, $day, intval($year)) && (gmmktime(0, 0, 0, $month, $day, intval($year)) < time())) {
                return true;
            }
        } elseif (checkdate($month, $day, intval('18' . $year)) || checkdate($month, $day, intval('19' . $year)) || (checkdate($month, $day, intval('20' . $year)) && (gmmktime(0, 0, 0, $month, $day, intval('20' . $year) < time())))) {
            return true;
        }
        
        return false;
    }
}