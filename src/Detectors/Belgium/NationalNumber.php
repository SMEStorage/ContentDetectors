<?php
namespace SME\ContentDetectors\Detectors\Belgium;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class NationalNumber
 *
 * Detector implementation for Belgian National Number
 *
 * @package SME\ContentDetectors\Detectors\Belgium
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NationalNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'beNationalNumber';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{10})\b/um';
    }
}
