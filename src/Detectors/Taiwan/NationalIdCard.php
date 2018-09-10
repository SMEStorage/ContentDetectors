<?php
namespace SME\ContentDetectors\Detectors\Taiwan;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class NationalIdCard
 *
 * Detector implementation for Taiwanese National ID Card Number - ROC ID
 * https://en.wikipedia.org/wiki/National_identification_number#Taiwan
 *
 * @package SME\ContentDetectors\Detectors\Taiwan
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NationalIdCard extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'twNationalIdCard';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([A-Z][12]\d{8})\b/uim';
    }
    
 
    /**
     * Validate Taiwanese National ID Card Number
     * https://wilhelmliao.wordpress.com/2011/05/09/taiwan-identity-number-validation/
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
       $idCardNumber = strtoupper($match);
     
       $letters = array(
           'A' => 10,
           'B' => 11,
           'C' => 12,
           'D' => 13,
           'E' => 14,
           'F' => 15,
           'G' => 16,
           'H' => 17,
           'I' => 34,
           'J' => 18,
           'K' => 19,
           'L' => 20,
           'M' => 21,
           'N' => 22,
           'O' => 35,
           'P' => 23,
           'Q' => 24,
           'R' => 25,
           'S' => 26,
           'T' => 27,
           'U' => 28,
           'V' => 29,
           'W' => 32,
           'X' => 30,
           'Y' => 31,
           'Z' => 33,
       );
       
       $idCardNumber = strval($letters[$idCardNumber[0]]) . substr($idCardNumber, 1);
        
       $checksum = 0;
       $weights = array(1, 9, 8, 7, 6, 5, 4, 3, 2, 1, 1);
       foreach ($weights as $position => $weight) {
           $digit =  $idCardNumber[$position];
           $checksum += $weight * $digit;
       }
        
       return (($checksum % 10) == 0) ? true : false;
    }
    
}