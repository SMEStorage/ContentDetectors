<?php
namespace SME\ContentDetectors\Detectors\Australia;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;
use \Validate_AU as TaxFileNumberValidator;
use Validate_AU;

/**
 * Class TaxFileNumber
 *
 * Detector implementation for Australian Tax File Numbers
 *
 * @package SME\ContentDetectors\Detectors\Australia
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class TaxFileNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    protected $code  = 'auTaxFileNumber';
     
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{2,3}[- ]?\d{3}[- ]?\d{3})\b/um';
    }

    /**
     * Provides a callback to validate each match found.
     *
     * @param $match
     * @return Match
     */
    public function validateMatch($match)
    {
        
        $validate = TaxFileNumberValidator::ssn($match);
        
        if (!$validate) {
            return false;
        }

        $result = new Match();
        $result->setMatchType(self::class)
            ->setMatchingContent($match);

        return $result;
    }
    
   
}