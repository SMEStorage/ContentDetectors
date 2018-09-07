<?php
namespace SME\ContentDetectors\Detectors\Israel;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class NationalIdNumber
 *
 * Detector implementation for Israeli National ID Number - Mispar Zehut
 * https://en.wikipedia.org/wiki/National_identification_number#Israel
 *
 * @package SME\ContentDetectors\Detectors\Israel
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NationalIdNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'ilNationalIdCard';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{9})\b/um';
    }
 
    /**
     * Validate Israeli National ID Number by checksum
     * http://halemo.net/info/idcard/
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
        // remove anything other than digits
        $nationalIdNumber = preg_replace("/[^\d]/u", "", $match);
         
        // length check
        if (strlen($nationalIdNumber) != 9) {
            return false;
        }
     
        $checksum = 0;
        for ($i = 0; $i < 9; $i ++) {
            $cheknum = intval($nationalIdNumber[$i]) * ($i % 2 + 1);
            if ($cheknum > 9) {
                $cheknum = ($cheknum % 10) + 1;
            }
            $checksum += $cheknum;
        }
        
        if (($checksum % 10) == 0) {
            return true;
        }
         
        return false;
         
    }
}