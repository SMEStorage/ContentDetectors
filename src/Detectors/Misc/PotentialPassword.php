<?php
namespace SME\ContentDetectors\Detectors\Misc;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;

/**
 * Class PotentialPassword
 *
 * Detector implementation for potential passwords
 *
 * @package SME\ContentDetectors\Detectors\Misc
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class PotentialPassword extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'potentialpwd';
     
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        //At least one upper case English letter, (?=.*?[A-Z])
        //At least one lower case English letter, (?=.*?[a-z])
        //At least one digit, (?=.*?[0-9])
        //At least one special character (?=.*?[#?!@$ %^&*-])
        //Minimum eight in length and no space or new line [^\s]{8,} 
        
        return '/\b((?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[\#\?\!\@\$\%\^\&\*\-])[^\s]{8,})\b/um';
    }

    
    
  
     
   
}