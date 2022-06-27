<?php
namespace SME\ContentDetectors\Detectors\Germany;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class Passport
 *
 * Detector implementation for German Passports
 *
 * @package SME\ContentDetectors\Detectors\Germany
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Passport extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'dePassport';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([0-9CFGHJKLMNPRTVWXYZ]{9})\b/um';
    }
 
}
