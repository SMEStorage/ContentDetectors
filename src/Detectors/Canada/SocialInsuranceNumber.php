<?php
namespace SME\ContentDetectors\Detectors\Canada;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;
use \Validate_CA as SocialInsuranceNumberValidator;

/**
 * Class SocialInsuranceNumber
 *
 * Detector implementation for Canadian Social Insurance Numbers
 *
 * @package SME\ContentDetectors\Detectors\Canada
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class SocialInsuranceNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'caSin';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{3}[ -]?\d{3}[ -]?\d{3})\b/um';
    }
    
    
    /**
     * Provides a callback to validate each match found.
     *
     * @param $match
     * @return Match
     */
    public function validateMatch($match)
    {
        $validate = SocialInsuranceNumberValidator::ssn($match);
    
        if (!$validate) {
            return false;
        }
    
        $result = new Match();
        $result->setMatchType(self::class)
        ->setMatchingContent($match);
    
        return $result;
    }
   
}