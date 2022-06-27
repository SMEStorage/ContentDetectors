<?php
namespace SME\ContentDetectors\Detectors\UK;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class DrivingLicense
 *
 * Detector implementation for UK Driving Licenses
 *
 * @package SME\ContentDetectors\Detectors\UK
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class DrivingLicense extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'ukDrivingLicense';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([A-Z]{5}[0-9]{6}[A-Z0-9]{5})\b/umi';
    }
 
}
