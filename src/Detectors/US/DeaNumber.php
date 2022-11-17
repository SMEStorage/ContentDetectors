<?php
namespace SME\ContentDetectors\Detectors\US;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;
 
/**
 * Class DeaNumber
 *
 * Detector implementation for US DEA Numbers
 * https://en.wikipedia.org/wiki/DEA_number
 *
 * @package SME\ContentDetectors\Detectors\US
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class DeaNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'usDea';
     
    /**
     * Returns the regular expression used to initially detect the content
     * https://en.wikipedia.org/wiki/DEA_number#Current_format
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([ABCDEFGHJKLMPRSTUX][A-Z9]\d{7})\b/uim';
    }
  
    
    /**
     * Validate US DEA Numbers by checksum
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
       $idCardNumber = substr(trim($match), -7);
         
       $checksum = 0;
       $weights = array(1, 2, 1, 2, 1, 2, 0);
       foreach ($weights as $position => $weight) {
            $digit = $idCardNumber[$position];
            $checksum += $weight * $digit;
       }
        
       return (($checksum % 10) == $idCardNumber[6]) ? true : false;
   }
    
    
    
}
