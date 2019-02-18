<?php
namespace SME\ContentDetectors\Detectors\SouthAfrica;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;
use SME\ContentDetectors\Validators\Luhn as LuhnAlgorithm;

/**
 * Class NationalIdNumber
 *
 * Detector implementation for South African National ID Number   
 * https://en.wikipedia.org/wiki/National_identification_number#South_Africa
  *
 * @package SME\ContentDetectors\Detectors\SouthAfrica
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NationalIdNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'zaNationalIdNumber';
    
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
        return '/\b(\d{6}[0459]\d{3}[01][89]\d)\b/um';
    }
 
    /**
     * Validate South African National ID Number  
     * https://en.wikipedia.org/wiki/National_identification_number#South_Africa
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
        // remove anything other than digits
        $nationalIdNumber = preg_replace("/[^\d]/u", "", $match);
         
        // length check
        if (strlen($nationalIdNumber) != 13) {
            return false;
        }
        
        if ($this->validateNationalIdNumberDate($nationalIdNumber)) {
             
            $cheknum = $this->getValidator()->calculate(substr($nationalIdNumber, 0, 12));
            
            if (intval($nationalIdNumber[12]) == $cheknum) {
                return true;
            }
        }
        
        return false;
         
    }
    
    /**
     * Validate South African National ID Number date 
     *
     * @param string
     * @return bool
     */
    private function validateNationalIdNumberDate($nationalIdNumber)
    {
        $year = substr($nationalIdNumber, 0, 2);
        $month = intval(substr($nationalIdNumber, 2, 2));
        $day = intval(substr($nationalIdNumber, 4, 2));
        
        
        if (checkdate($month, $day, intval('18' . $year)) || 
            checkdate($month, $day, intval('19' . $year)) || 
            (checkdate($month, $day, intval('20' . $year)) && (gmmktime(0, 0, 0, $month, $day, intval('20' . $year)) < time()))) {
            return true;
        }
        
        return false;
    }
}