<?php
namespace SME\ContentDetectors\Detectors\Misc;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class Ip
 *
 * Detector implementation for IPs
 *
 * @package SME\ContentDetectors\Detectors\Misc
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Ip extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'ip';
     
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(((25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]?)\.((25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9]?[0-9])\.){2}(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9]?[0-9]))|(([0-9a-f]){1,4}(:([0-9a-f]){1,4}){1,7}))\b/um';
    }

    
    /**
     * Validate IP
     *
     * @param string
     * @return bool
     */
     
    protected function validate($match)
    {
        $valid  = filter_var($match, FILTER_VALIDATE_IP);
    
        return $valid ? true : false;
    }
     
   
}