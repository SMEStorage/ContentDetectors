<?php
namespace SME\ContentDetectors\Detectors\Misc;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class Email
 *
 * Detector implementation for Email addresses
 *
 * @package SME\ContentDetectors\Detectors\Misc
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Email extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'email';
     
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([\-\w\+](\.?[\-\w\+])*@\[?([0-9a-z](\-?\_?[0-9a-z])*\.)+[a-z0-9\-]{2,64}\]?)/umi';
    }

    
    /**
     * Validate email
     *
     * @param string
     * @return bool
     */
     
    protected function validate($match)
    {
       $valid  = filter_var($match, FILTER_VALIDATE_EMAIL);
      
       return $valid ? true : false;
    }
   
}