<?php
namespace SME\ContentDetectors\Detectors\Chile;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class NationalIdNumber
 *
 * Detector implementation for Chilean National Identification Number - RUN (Rol Único Nacional), RUT (Rol Único Tributario)
 * https://en.wikipedia.org/wiki/National_identification_number#Chile
 *
 * @package SME\ContentDetectors\Detectors\Chile
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NationalIdNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'clNationalIdNumber';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{1,2}[\- \.,]?\d{3}[\- \.,]?\d{3}[\- \.]?[0-9kK])\b/um';
    }
    
     
    /**
     * Validate Chilean National Identification Number 
     * based on https://www.vesic.org/english/blog-eng/net/verifying-chilean-rut-code-tax-number/
     *
     * @param string
     * @return bool
     */
     protected function validate($match)
     {
         
        $idNumber = preg_replace("/[^\dK]/iu", "", $match);
    
        // Check for 8-9 length
        $length = strlen($idNumber);
        if ($length == 8) {
            $idNumber = '0' . $idNumber;
            $length = strlen($idNumber);
        }
        if ($length == 9) {
    
            $sum = 0;
            $weights = array(3, 2, 7, 6, 5, 4, 3, 2, 0);
            foreach ($weights as $position => $weight) {
                $digit = $idNumber[$position];
                $sum += $weight * intval($digit);
            }
            $cheknum = 11 - $sum % 11;
            
            if ($cheknum == 11) {
                $cheknum = 0;
            }
            
            if (($cheknum == 0) && (strtoupper($idNumber[8]) == 'K')) {
                return false;
            }
            
            if (($cheknum == 10) && (strtoupper($idNumber[8]) == 'K')) {
                return true;
            }
             
            if (intval($cheknum) == intval($idNumber[8])) {
                return true;
            }
           
        }
    
        return false;
    }
    
     
     
}