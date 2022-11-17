<?php
namespace SME\ContentDetectors\Detectors\US;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class Zip
 *
 * Detector implementation for US Zip Code
 *
 * @package SME\ContentDetectors\Detectors\US
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Zip extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'usZip';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b((\d{5})(?:[ \-](\d{4}))?)\b/um';
    }
}
