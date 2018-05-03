<?php
namespace SME\ContentDetectors\Detectors\UK;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Detectors\DetectorNextRule;
use SME\ContentDetectors\Match;

/**
 * Class Passport
 *
 * Detector implementation for UK Passports
 *
 * @package SME\ContentDetectors\Detectors\UK
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Passport extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'ukPassport';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{9})\b/um';
    }
 
    /**
     * Returns regex to been matched on whole content with AND condition with default
     * regex (getRegularExpression) to identify found content as matched
     *
     * @return array of DetectorNextRule(s)
     */
    public function getDefaultNext()
    {
        return array(
            new DetectorNextRule('/\b((Passport)|(Travel\s*document))\b/umi', 'UK passport sub-rule')
        );
    }
    
}