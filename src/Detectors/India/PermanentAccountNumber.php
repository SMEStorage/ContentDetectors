<?php
namespace SME\ContentDetectors\Detectors\India;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class PermanentAccountNumber
 *
 * Detector implementation for Indian Permanent Account Numbers (PAN) 
 *
 * @package SME\ContentDetectors\Detectors\India
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class PermanentAccountNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'inPersonalNumber';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([A-Z]{3}[ABCFGHLJPTK][A-Z]\d{4}[A-Z]{1})\b/ium';
    }
 
}