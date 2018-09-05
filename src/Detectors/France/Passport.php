<?php
namespace SME\ContentDetectors\Detectors\France;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class Passport
 *
 * Detector implementation for Franch Passports
 *
 * @package SME\ContentDetectors\Detectors\France
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Passport extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'frPassport';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{2}[A-Z]{2}\d{5})\b/um';
    }
 
}