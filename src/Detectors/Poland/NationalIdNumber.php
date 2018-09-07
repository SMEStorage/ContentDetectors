<?php
namespace SME\ContentDetectors\Detectors\Poland;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class NationalIdNumber
 *
 * Detector implementation for Polish National ID Number - PESEL
  *
 * @package SME\ContentDetectors\Detectors\Poland
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NationalIdNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'plNationalIdNumber';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{11})\b/um';
    }
 
    /**
     * Validate Polish National ID Number (PESEL)
     * https://en.wikipedia.org/wiki/PESEL#Check_sum_calculation
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
        // remove anything other than digits
        $nationalIdNumber = preg_replace("/[^\d]/u", "", $match);
         
        // length check
        if (strlen($nationalIdNumber) != 11) {
            return false;
        }
        
        if ($this->validateNationalIdNumberDate($nationalIdNumber)) {
            $weights = array(1, 3, 7, 9, 1, 3, 7, 9, 1, 3);
            
            $checksum = 0;
            foreach ($weights as $position => $weight) {
                $digit = $nationalIdNumber[$position];
                $checksum += $weight * $digit;
            }
            $checksum %= 10;
            
            $cheknum = 0;
            if ($checksum != 0) {
                $cheknum = 10 - $checksum;
            }
            
            if (intval($match[10]) == $cheknum) {
                return true;
            }
        }
        
        return false;
         
    }
    
    /**
     * Validate Poland National ID number date 
     * https://en.wikipedia.org/wiki/PESEL#Birthdates
     *
     * @param string
     * @return bool
     */
    private function validateNationalIdNumberDate($nationalIdNumber)
    {
        $year = substr($nationalIdNumber, 0, 2);
        $month = intval(substr($nationalIdNumber, 2, 2));
        $day = intval(substr($nationalIdNumber, 4, 2));
        
        if ($month <= 12) {
            $year = '19' . $year;
        } elseif (($month >= 21) && ($month <= 32)) {
            $year = '20' . $year;
            $month -= 20;
        } elseif (($month >= 41) && ($month <= 52)) {
            $year = '21' . $year;
            $month -= 40;
        } elseif (($month >= 61) && ($month <= 72)) {
            $year = '22' . $year;
            $month -= 60;
        } elseif (($month >= 81) && ($month <= 92)) {
            $year = '18' . $year;
            $month -= 80;
        }
         
        if (checkdate($month, $day, intval($year)) && (gmmktime(0, 0, 0, $month, $day, $year) < time())) {
            return true;
        }
        
        return false;
    }
}