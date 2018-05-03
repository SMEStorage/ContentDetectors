<?php
namespace SME\ContentDetectors\Detectors\Bank;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;
use \IBAN as IbanAccountNumberValidator;

/**
 * Class IbanAccountNumber
 *
 * Detector implementation for IBAN Account Numbers
 *
 * @package SME\ContentDetectors\Detectors\Bank
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class IbanAccountNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'bankIban';
    
     
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([a-zA-Z]{2}[0-9]{2}[ -]?([a-zA-Z0-9]{4}[ -]?){3,6}[a-zA-Z0-9]{0,4})\b/uim';
    }

    /**
     * Provides a callback to validate each match found.
     *
     * @param $match
     * @return Match
     */
    public function validateMatch($match)
    {   
        $validate = IbanAccountNumberValidator::Verify(preg_replace("/[^\dA-Z]/ui", "", $match));
          
        if (!$validate) {
            return false;
        }

        $result = new Match();
        $result->setMatchType(self::class)
            ->setMatchingContent($match);

        return $result;
    }
    
    
    
}