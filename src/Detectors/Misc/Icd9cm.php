<?php
namespace SME\ContentDetectors\Detectors\Misc;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorNextRule;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class Icd9cm
 *
 * Detector implementation for International Classification of Diseases - ICD 9-CM Code
 *
 * @package SME\ContentDetectors\Detectors\Misc
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Icd9cm extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'icd9cm';
     
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(ICD[ -]?9([ -]?CM)?)\b/umi';
    }

    /**
     * Return regex to been matched on whole content with AND condition with default
     * regex (getRegularExpression) to identify found content as matched
     *
     * @return array of DetectorNextRule(s)
     */
    public function getDefaultNext()
    {
        return array(
            new DetectorNextRule('/\b([EV]?\d{3}(\.?\d{0,5})?)\b/umi', 'ICD 9-CM Code sub-rule')
        );
    }
    
  
}
