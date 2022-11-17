<?php
namespace SME\ContentDetectors\Detectors\Poland;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class NationalIdCard
 *
 * Detector implementation for Polish National Identity Cards
 * https://en.wikipedia.org/wiki/Polish_identity_card
 *
 * @package SME\ContentDetectors\Detectors\Poland
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NationalIdCard extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'plNationalIdCard';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([A-Z]{3}[ \-]?\d{6})\b/uim';
    }
 
    /**
     * Validate Polish National Identity Cards
     * there are 2 validation algorithms described in English and in polish version
     * https://en.wikipedia.org/wiki/Polish_identity_card#Validation
     * https://pl.wikipedia.org/wiki/Dow%C3%B3d_osobisty_w_Polsce#Obecny_wz%C3%B3r,_wymiana_i_wa%C5%BCno%C5%9B%C4%87_dowodu
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
       $match = strtoupper($match);
        
       if ($this->validateByWeights($match, array(7, 3, 1, 9, 7, 3, 1, 7, 3) /*weights are described in English and Polish wiki*/, true)) {
           return true;
       }
       
       if ($this->validateByWeights($match, array(1, 9, 3, 7, 1, 9, 3, 1, 9) /*weights are described in Polish wiki*/)) {
           return true;
       }
       
       if ($this->validateByWeights($match, array(3, 7, 9, 1, 3, 7, 9, 3, 7) /*weights are described in Polish wiki*/)) {
           return true;
       }
       
       if ($this->validateByWeights($match, array(9, 1, 7, 3, 9, 1, 7, 9, 1) /*weights are described in Polish wiki*/)) {
           return true;
       }
             
       return false;
    }
    
    /**
     * Validate Polish National Identity Cards with weigths
     * there are 2 validation algorithms described in English and in Polish version of wiki
     * https://en.wikipedia.org/wiki/Polish_identity_card#Validation
     * https://pl.wikipedia.org/wiki/Dow%C3%B3d_osobisty_w_Polsce#Obecny_wz%C3%B3r,_wymiana_i_wa%C5%BCno%C5%9B%C4%87_dowodu
     *
     * @param string $idCardNumber
     * @param array $weights
     * @return bool
     */
    private function validateByWeights($idCardNumber, $weights, $with_control_digit = false) {
        $letters = array(
            'A' => 10,
            'B' => 11,
            'C' => 12,
            'D' => 13,
            'E' => 14,
            'F' => 15,
            'G' => 16,
            'H' => 17,
            'I' => 18,
            'J' => 19,
            'K' => 20,
            'L' => 21,
            'M' => 22,
            'N' => 23,
            'O' => 24,
            'P' => 25,
            'Q' => 26,
            'R' => 27,
            'S' => 28,
            'T' => 29,
            'U' => 30,
            'V' => 31,
            'W' => 32,
            'X' => 33,
            'Y' => 34,
            'Z' => 35,
        );
        
        $checksum = 0;
        foreach ($weights as $position => $weight) {
            $digit =  $idCardNumber[$position];
            $digit = isset($letters[$digit]) ? $letters[$digit] : intval($digit);
        
            $checksum += $weight * $digit;
        }
        $cheknum  = $checksum % 10;
        
        //condition is described in English wiki
        //https://en.wikipedia.org/wiki/Polish_identity_card#Validation
        if ((intval($idCardNumber[3]) == $cheknum) && $with_control_digit) {
            return true;
        }
        
        //condition is described in Polish wiki
        //https://pl.wikipedia.org/wiki/Dow%C3%B3d_osobisty_w_Polsce#Obecny_wz%C3%B3r,_wymiana_i_wa%C5%BCno%C5%9B%C4%87_dowodu
        if ($cheknum == 0) {
            return true;
        }
        
        return false;
    }
    
}
