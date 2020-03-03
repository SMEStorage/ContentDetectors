<?php
namespace SME\ContentDetectors\Detectors\Bank;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
 

/**
 * Class RoutingTransitNumber
 *
 * Detector implementation for ABA routing transit numbers
 *
 * @package SME\ContentDetectors\Detectors\Bank
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class RoutingTransitNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'bankRtn';
    
   
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(((0[0-9])|(1[0-2])|(2[1-9])|(3[0-2])|(6[1-9])|(7[0-2])|80)([0-9]{7}))\b/uim';
    }
}