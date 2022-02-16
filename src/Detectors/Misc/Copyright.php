<?php
namespace SME\ContentDetectors\Detectors\Misc;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;

/**
 * Class Copyright
 *
 * Detector implementation for Copyrights
 *
 * @package SME\ContentDetectors\Detectors\Misc
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Copyright extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    protected $code  = 'copyright';
     
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/(\bcopyrights?\b)|(\bcopyrighted\b)|(&copy;)|(Ⓒ)/uim';
    }
}