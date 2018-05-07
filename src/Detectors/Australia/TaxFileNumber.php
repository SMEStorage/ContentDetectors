<?php
namespace SME\ContentDetectors\Detectors\Australia;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

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
        
        $validate = $this->ValidateTaxFileNumber($match);
        
        if (!$validate) {
            return false;
        }

        $result = new Match();
        $result->setMatchType(self::class)
            ->setMatchingContent($match);

        return $result;
    }
    
    
    /**  
     * Validate TFN by checksum
     * https://en.wikipedia.org/wiki/Tax_file_number#Check_digit
     * https://github.com/sidorares/tfn/files/290459/Tax_file_number_.TFN._algorithm_8_digit.pdf
     *
     *
     * @param $tfn string
     * @return bool
     */
    
    
    private function ValidateTaxFileNumber($tfn)
    {
        // remove anything other than digits
        $tfn = preg_replace("/[^\d]/u", "", $tfn);
        $weights = array();
        // check length is 9 digits
        if (strlen($tfn) == 9) {
            $weights = array(
                1,
                4,
                3,
                7,
                5,
                8,
                6,
                9,
                10
            );
        } elseif (strlen($tfn) == 8) {
            $weights = array(
                10,
                7,
                8,
                4,
                6,
                3,
                5,
                1 
            );
        }
        
        if (! empty($weights)) {
            $sum = 0;
            foreach ($weights as $position => $weight) {
                $digit = $tfn[$position];
                $sum += $weight * $digit;
            }
            return ($sum % 11) == 0;
        }
         return false;
    }
   
}