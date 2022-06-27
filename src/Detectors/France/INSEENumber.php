<?php
namespace SME\ContentDetectors\Detectors\France;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class INSEENumber
 *
 * Detector implementation for Franch INSEE Numbers
 *
 * @package SME\ContentDetectors\Detectors\France
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class INSEENumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'frSsn';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{13}[ -]?\d{2})\b/um';
    }
 
}
