<?php
namespace SME\ContentDetectors\Detectors\SouthKorea;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class Passport
 *
 * Detector implementation for South Korean Passports
 *
 * @package SME\ContentDetectors\Detectors\SouthKorea
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Passport extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'krPassport';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(([A-Z]{2}\d{7})|([MS]{1}\d{8})|(\d{9}))\b/uim';
    }
 
}
