<?php
namespace SME\ContentDetectors\Detectors\UK;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;
use ByStones\NHSNumber as NHSNumberValidator;

/**
 * Class NhsNumber
 *
 * Detector implementation for UK NHS Numbers
 *
 * @package SME\ContentDetectors\Detectors\UK
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NhsNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'ukNhsNumber';
    
   
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{3}[- ]?\d{3}[- ]?\d{4})\b/um';
    }

    /**
     * Validate UK NHS Numbers
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
        $nhs = new NHSNumberValidator($match);
        
        return $nhs->isValid();
    }
    
}