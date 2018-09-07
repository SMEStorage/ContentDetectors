<?php
namespace SME\ContentDetectors\Detectors\Belgium;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class NationalRegisterNumber
 *
 * Detector implementation for Belgian National Register Number
 * https://fr.wikipedia.org/wiki/Num%C3%A9ro_de_registre_national
 * https://en.wikipedia.org/wiki/National_identification_number#Belgium
 *
 * @package SME\ContentDetectors\Detectors\Belgium
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NationalRegisterNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'beNationalRegisterNumber';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([\d]{2}\.?[\d]{2}\.?[\d]{2}[\-\. ]?[\d]{3}[\.\- ]?[\d]{2})\b/um';
    }
    
  
    /**
     * Validate National Register Number by checksum
     * https://nl.wikipedia.org/wiki/Rijksregisternummer
     * https://github.com/pear/Validate_BE/blob/master/Validate/BE.php
     *
     * @param string
     * @return bool
     */
     protected function validate($match)
     {
        // remove anything other than digits
        $registerNumber = preg_replace("/[^\d]/u", "", $match);
         
        // length check
        if (strlen($registerNumber) != 11) {
            return false;
        }
        
        // separate for parts
        $year = intval(substr($registerNumber, 0, 2));
        $month = intval(substr($registerNumber, 2, 2));
        $day = intval(substr($registerNumber, 4, 2));
        $validationNumber = substr($registerNumber, 0, 9);
        $validationChecksum  = substr($registerNumber, -2);
        
        //date validation
        
        //day validation
        if ($day > 31) {
            return false;
        }
            
        // month validation
        if ($month > 12) {
            if (($month <= 20) || ($month >= 32)) {
                if (($month <= 40) || ($month >= 52)) {
                    return false;
                }
            }
        }
            
        // checksum validation
        if ($this->CheckChecksum($validationNumber, $validationChecksum) || $this->CheckChecksum('2' . $validationNumber, $validationChecksum)) {
            return true;
        }
         
        return false;
       
    }
    
    /**
     * Validate National Register Number checksum
     *
     * @param string
     * @param string
     * @return bool
     */
    
    private function CheckChecksum($validationNumber, $validationChecksum)
    {
        $validationNumber = intval($validationNumber);
        $calculatedChecksum = 97 - ($validationNumber % 97);
        
        return (intval($calculatedChecksum) == intval($validationChecksum)) ? true : false;
    }
}