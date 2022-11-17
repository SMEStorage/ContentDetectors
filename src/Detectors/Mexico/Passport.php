<?php
namespace SME\ContentDetectors\Detectors\Mexico;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class Passport
 *
 * Detector implementation for Mexican Passports
 *
 * @package SME\ContentDetectors\Detectors\Mexico
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Passport extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'mxPassport';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(([A-Z]{1}\d{8})|([A-Z]{3}-\d{5}))\b/uim';
    }
 
}
