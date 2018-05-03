<?php
namespace SME\ContentDetectors\Detectors\Canada;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class QuebecInsuranceNumber
 *
 * Detector implementation for Canadian Quebec Insurance Numbers
 *
 * @package SME\ContentDetectors\Detectors\Canada
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class QuebecInsuranceNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'caQuebecInsuranceNumber';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([A-Z]{4}[ ]?\d{4}[ ]?\d{4})\b/um';
    }
 
}