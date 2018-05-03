<?php
namespace SME\ContentDetectors\Detectors\Australia;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class MedicareNumber
 *
 * Detector implementation for Australian Medicare Numbers
 *
 * @package SME\ContentDetectors\Detectors\Australia
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class MedicareNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    protected $code  = 'auMedicare';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([2-6]\d{3}[ ]?\d{5}[ ]?\d{1}[- ]?\d?)\b/um';
    }

    /**
     * Provides a callback to validate each match found.
     *
     * @param $match
     * @return Match
     */
    public function validateMatch($match)
    {
        
        $validate = $this->ValidateMedicareNumber($match);
        
        if (!$validate) {
            return false;
        }

        $result = new Match();
        $result->setMatchType(self::class)
            ->setMatchingContent($match);

        return $result;
    }
    
    
    /** validateMedicareNumber
    * Checks medicare card number for validity
    * using the published checksum algorithm.
    * Returns: true if the number is valid, false otherwise.
    * Note - this expects 11 digits including the IRN.
    * To validate numbers without IRNs, change the length
    * check to 10 digits.
    *
    * Source: http://www.clearwater.com.au/code
    * Author: Guy Carpenter
    * License: The author claims no rights to this code.
    * Use it as you wish.
    * 
    * @param $MedicareNo
    * @return bool
    */
    
  
    private function ValidateMedicareNumber($MedicareNo)
    {
        $medicareNo = preg_replace("/[^\d]/u", "", $MedicareNo);
    
        // Check for 11 or 10 digits
        $length = strlen($medicareNo);
        if (($length == 11) || ($length == 10)) {
            // Test checksum
            if (preg_match("/^(\d{8})(\d)/u", $medicareNo, $matches)) {
                $base = $matches[1];
                $checkDigit = $matches[2];
                $sum = 0;
                $weights = array(1, 3, 7, 9, 1, 3, 7, 9);
                foreach ($weights as $position => $weight) {
                    $sum += $base[$position] * $weight;
                }
                return (($sum % 10) == intval($checkDigit));
            }
        }
        return false;
    }
   
}