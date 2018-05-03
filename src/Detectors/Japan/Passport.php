<?php
namespace SME\ContentDetectors\Detectors\Japan;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class Passport
 *
 * Detector implementation for Japanese Passports
 *
 * @package SME\ContentDetectors\Detectors\Japan
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Passport extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'jpPassport';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([A-Z]{2}\d{7})\b/uim';
    }
 
}