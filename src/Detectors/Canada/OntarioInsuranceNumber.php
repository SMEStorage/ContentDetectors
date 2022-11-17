<?php
namespace SME\ContentDetectors\Detectors\Canada;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class OntarioInsuranceNumber
 *
 * Detector implementation for Canadian Ontario Insurance Numbers
 *
 * @package SME\ContentDetectors\Detectors\Canada
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class OntarioInsuranceNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'caOntarioInsuranceNumber';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{4}[ -]?\d{3}[ -]?\d{3}([ -]?[A-Z]{2})?)\b/um';
    }
}
