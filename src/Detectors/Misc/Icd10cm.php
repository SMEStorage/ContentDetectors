<?php
namespace SME\ContentDetectors\Detectors\Misc;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorNextRule;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class Icd10cm
 *
 * Detector implementation for International Classification of Diseases - ICD 10-CM Codes
 *
 * @package SME\ContentDetectors\Detectors\Misc
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Icd10cm extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'icd10cm';
     
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(ICD[ -]?10([ -]?CM)?)\b/umi';
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
            new DetectorNextRule('/\b([ABCDEFGHIJKLMNOPQRSTVYZU]{1}\d{2}(\.?\d{0,5})?)\b/umi', 'ICD 10-CM Code sub-rule')
        );
    }
    
  
}