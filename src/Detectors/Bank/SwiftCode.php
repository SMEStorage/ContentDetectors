<?php
namespace SME\ContentDetectors\Detectors\Bank;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorNextRule;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;
use IsoCodes\SwiftBic as SwiftCodeValidator;

/**
 * Class SwiftCode
 *
 * Detector implementation for Swift Codes
 *
 * @package SME\ContentDetectors\Detectors\Bank
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class SwiftCode extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'bankSwift';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(([A-Z]){4}([A-Z]){2}([0-9A-Z]){2}([0-9A-Z]{3})?)\b/um';
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
            new DetectorNextRule('/\b(SWIFT)\b/uim', 'Bank SWIFT sub-rule')
        );
    }
    
    /**
     * Validate Swift Codes
     *
     * @param string
     * @return bool
     */
     
    protected function validate($match)
    {
        $valid = SwiftCodeValidator::validate(preg_replace("/[^\dA-Z]/ui", "", $match));
    
        return $valid ? true : false;
    }
   
}