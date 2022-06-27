<?php
namespace SME\ContentDetectors\Detectors\Croatia;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class PersonalIdentificationNumber
 *
 * Detector implementation for Croatian Personal Identification Number - OBI
 * https://en.wikipedia.org/wiki/Personal_identification_number_(Croatia)
 *
 * @package SME\ContentDetectors\Detectors\Croatia
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class PersonalIdentificationNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'crPersonalIdentificationNumber';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{11})\b/um';
    }

    /**
     * Validate Croatian Personal Identification Number
     * https://en.wikipedia.org/wiki/Personal_identification_number_(Croatia)#Characteristics
     * standard ISO 7064, module 11.10
     * based on code https://github.com/mmandaric/ISO7064-MOD-11-10/blob/master/kont-zn1.c
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
        $personalIdNumber = preg_replace("/[^\d]/u", "", $match);
        
        $personalIdNumberLength = strlen($personalIdNumber);
        if ($personalIdNumberLength == 11) {
            $cheknum = 10;
            
            for ($i = 0; $i < $personalIdNumberLength - 1; $i ++) {
                
                $cheknum += intval($personalIdNumber[$i]);
                $cheknum = $cheknum % 10;
                if ($cheknum == 0) {
                    $cheknum = 10;
                }
                $cheknum = $cheknum * 2 % 11;
            }
            
            $cheknum = ($cheknum == 1) ? 0 : (11 - $cheknum);
            
            if ($cheknum == intval($personalIdNumber[$personalIdNumberLength - 1])) {
                return true;
            }
        }
        
        return false;
    }
    
     
     
}
