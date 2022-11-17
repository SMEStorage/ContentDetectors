<?php
namespace SME\ContentDetectors\Detectors\Norway;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class NationalIdNumber
 *
 * Detector implementation for Norwegian National ID Number - fødselsnummer
 * https://en.wikipedia.org/wiki/National_identification_number#Norway
 *
 * @package SME\ContentDetectors\Detectors\Norway
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NationalIdNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'noNationalIdNumber';
    
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
     * Validate Norwegian National ID Number by checksum
     * https://github.com/mikaello/norwegian-national-id-validator
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
        // remove anything other than digits
        $nationalIdNumber = preg_replace("/[^\d]/u", "", $match);
         
        // length check
        if (strlen($nationalIdNumber) != 11) {
            return false;
        }
        
        if ($this->validateNationalIdNumberDate($nationalIdNumber)) {
            $weights = array(3, 7, 6, 1, 8, 9, 4, 5, 2, 1);
             
            $checksum = 0;
            foreach ($weights as $position => $weight) {
                $digit = $nationalIdNumber[$position];
                $checksum += $weight * $digit;
            }
            if (($checksum % 11) == 0) {
                $weights = array(5, 4, 3, 2, 7, 6, 5, 4, 3, 2, 1);
            
                $checksum = 0;
                foreach ($weights as $position => $weight) {
                    $digit = $nationalIdNumber[$position];
                    $checksum += $weight * $digit;
                }
            
                if (($checksum % 11) == 0) {
                    return true;
                }
            }
        }
        
        return false;
         
    }
    
    /**
     * Validate Norwegian National ID Number by date 
     * https://no.wikipedia.org/wiki/F%C3%B8dselsnummer
     *
     * @param string
     * @return bool
     */
    private function validateNationalIdNumberDate($nationalIdNumber)
    {
        $day = intval(substr($nationalIdNumber, 0, 2));
        $month = intval(substr($nationalIdNumber, 2, 2));
        $year = substr($nationalIdNumber, 4, 2);
        
        $yearCentury = intval(substr($nationalIdNumber, 6, 3));
        
        if ($yearCentury <= 499) {
            if (checkdate($month, $day, intval('19' . $year))) { // 1900–1999
                return true;
            }
        } elseif (($yearCentury >= 500) && ($yearCentury <= 749)) {
            if (checkdate($month, $day, intval('18' . $year)) && (intval($year) >= 54)) { // 1854–1899
                return true;
            } elseif (checkdate($month, $day, intval('20' . $year)) && (mktime(0, 0, 0, $month, $day, intval('20' . $year)) < time())) { // 2000-2039
                return true;
            }
        } elseif (($yearCentury >= 749) && ($yearCentury <= 999)) {
            
            if (checkdate($month, $day, intval('20' . $year)) && (mktime(0, 0, 0, $month, $day, intval('20' . $year)) < time())) { // 2000-2039
                return true;
            } elseif (($yearCentury >= 900) && checkdate($month, $day, intval('19' . $year)) && (intval($year) >= 40)) { // 1940-1999
                return true;
            }
        }
         
        return false;
    }
}
