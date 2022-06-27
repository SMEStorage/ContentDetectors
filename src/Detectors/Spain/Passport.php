<?php
namespace SME\ContentDetectors\Detectors\Spain;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class Passport
 *
 * Detector implementation for Spainish Passports
 *
 * @package SME\ContentDetectors\Detectors\Spain
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Passport extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'esPassport';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([A-Z]{2,3}[ -]?\d{6})\b/um';
    }
 
}
