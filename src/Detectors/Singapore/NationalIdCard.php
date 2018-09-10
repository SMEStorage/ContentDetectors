<?php
namespace SME\ContentDetectors\Detectors\Singapore;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class NationalIdCard
 *
 * Detector implementation for Singaporean National Registration Identity Card (NRIC) Number
 * https://en.wikipedia.org/wiki/National_Registration_Identity_Card
 *
 * @package SME\ContentDetectors\Detectors\Singapore
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NationalIdCard extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'sgNationalIdCard';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([STFG]\d{7}[JZIHGFEDCBA])\b/uim';
    }
    
 
    /**
     * Validate Singaporean National Registration Identity Card (NRIC) Number
     * https://en.wikipedia.org/wiki/National_Registration_Identity_Card#Structure_of_the_NRIC_number/FIN
     * http://www.ngiam.net/NRIC/img011.jpg
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
       $idCardNumber = strtoupper($match);
        
       $checksum = 0;
       if (($idCardNumber[0] == 'T') || ($idCardNumber[0] == 'G')) {
           $checksum = 4;
       }
       $weights = array(2, 7, 6, 5, 4, 3, 2);
       foreach ($weights as $position => $weight) {
           $digit =  $idCardNumber[$position + 1];
           $checksum += $weight * $digit;
       }
       $controlPosition  = $checksum % 11;
       
       if (($idCardNumber[0] == 'S') || ($idCardNumber[0] == 'T'))
       {
           $controlSymbols = array('J', 'Z', 'I', 'H', 'G', 'F', 'E', 'D', 'C', 'B', 'A');
       }
       else
       {
           $controlSymbols = array('G', 'F', 'E', 'D', 'C', 'B', 'A', 'J', 'Z', 'I', 'H');
       }
       
       if ($idCardNumber[8] == $controlSymbols[$controlPosition]) {
           return true;
       }
       
       return false;
    }
    
}