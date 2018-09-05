<?php
namespace SME\ContentDetectors\Detectors\CzechRepublic;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class NationalIdCard
 *
 * Detector implementation for Czech Republic National identity cards
 * https://en.wikipedia.org/wiki/Czech_national_identity_card
 *
 * @package SME\ContentDetectors\Detectors\CzechRepublic
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NationalIdCard extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'czNationalIdCard';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{9})\b/um';
    }
 
}