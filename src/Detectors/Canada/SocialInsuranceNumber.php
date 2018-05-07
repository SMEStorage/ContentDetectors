<?php
namespace SME\ContentDetectors\Detectors\Canada;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;


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
         
        $validate = $this->ValidateSocialInsuranceNumber($match);

        if (!$validate) {
            return false;
        }
    
        $result = new Match();
        $result->setMatchType(self::class)
        ->setMatchingContent($match);
    
        return $result;
    }
    
     /**  
     * Validate Social Insurance Number by checksum
     *
     * @param $sin string
     * @return bool
     */
    
   
    private  function ValidateSocialInsuranceNumber($sin) {
         // remove anything other than digits
        $sin = preg_replace("/[^\d]/u", "", $sin);
         
        // length check
        if (strlen($sin) != 9) {
            return false;
        }
        
        // _luhn function declared in globalcitizen/php-iban package, file php-iban.php
        return _luhn($sin) ? false : true;
    }
   
}