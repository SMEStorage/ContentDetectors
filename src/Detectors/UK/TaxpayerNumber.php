<?php
namespace SME\ContentDetectors\Detectors\UK;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class TaxpayerNumber
 *
 * Detector implementation for UK Taxpayer Numbers
 *
 * @package SME\ContentDetectors\Detectors\UK
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class TaxpayerNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'ukTaxpayerNumber';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{5}[- ]?\d{5})\b/um';
    }
   
}
