<?php
namespace SME\ContentDetectors\Detectors\Misc;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;

/**
 * Class Cusip
 *
 * Detector implementation for CUSIP
 *
 * @package SME\ContentDetectors\Detectors\Misc
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Cusip extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'cusip';
     
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([A-Z0-9\*\#\@]{9})\b/ium';
    }

    
    /**
     * Validate IP
     *
     * @param string
     * @return bool
     */
     
    protected function validate($match)
    {
        
        return \DPRMC\CUSIP::isCUSIP($match) ? true : false;
    }
     
   
}