<?php
namespace SME\ContentDetectors\Detectors\NewZealand;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class HealthNumber
 *
 * Detector implementation for New Zealand National Health Number - NHI Number
 * https://en.wikipedia.org/wiki/NHI_Number
 *
 * @package SME\ContentDetectors\Detectors\NewZealand
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class HealthNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    protected $code  = 'nzHelthNumber';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([A-HJ-NP-Z]{3}\d{4})\b/uim';
    }

    /**
     * Validate New Zealand National Health Number
     * https://en.wikipedia.org/wiki/NHI_Number#Check_digit
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
        $checksum = 0;
        $letters = "ABCDEFGHJKLMNPQRSTUVWXYZ";
        for ($i = 0; $i < 3; $i ++) {
            $letterPos = stripos($letters, $match[$i]) + 1;
            $checksum += $letterPos * (7 - $i);
        }
        for ($i = 3; $i < 6; $i ++) {
            $checksum += intval($match[$i]) * (7 - $i);
        }
        
        $checksum %= 11;
        
        if ($checksum == 0) {
            return false;
        }
        
        $cheknum = 11 - $checksum;
        
        if ($cheknum == 10) {
            $cheknum = 0;
        }
        
        if (intval($match[6]) == $cheknum) {
            return true;
        }
        
        return false;
    }
   
}