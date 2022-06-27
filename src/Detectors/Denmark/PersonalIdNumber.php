<?php
namespace SME\ContentDetectors\Detectors\Denmark;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class NationalNumber
 *
 * Detector implementation for Danish Personal Identification Number - CPR-nummer
 * https://en.wikipedia.org/wiki/Personal_identification_number_(Denmark)
 *
 * @package SME\ContentDetectors\Detectors\Denmark
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class PersonalIdNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'dkPersonalIdNumber';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([\d]{6}[\-\. ]?[\d]{4})\b/um';
    }
    

    /**
     * Validate Danish Personal Identification Number by date
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
        // remove anything other than digits
        $personalIdNumber = preg_replace("/[^\d]/u", "", $match);
         
        // length check
        if (strlen($personalIdNumber) != 10) {
            return false;
        }
    
        // separate for parts
        $day = intval(substr($personalIdNumber, 0, 2));
        $month = intval(substr($personalIdNumber, 2, 2));
        $year = substr($personalIdNumber, 4, 2);
        $yearSelector = intval(substr($personalIdNumber, 6, 1));
         
        //https://da.wikipedia.org/wiki/CPR-nummer#Under_eller_over_100_.C3.A5r
        
        if (($yearSelector == 0) || ($yearSelector == 2) || ($yearSelector == 3)) {
            $year = '19' . $year;
        } elseif ($yearSelector == 4) {
            if ($year < 36) {
                $year = '20' . $year;
            } else {
                $year = '19' . $year;
            }
        } elseif (($yearSelector == 5) || ($yearSelector == 6) || ($yearSelector == 7) || ($yearSelector == 8)) {
            if ($year < 57) {
                $year = '20' . $year;
            } else {
                $year = '18' . $year;
            }
        } elseif ($yearSelector == 9) {
            if ($year < 36) {
                $year = '20' . $year;
            } else {
                $year = '19' . $year;
            }
        }
        $year = intval($year);
        
       
        //day validation and day must be less than today
        if (checkdate($month, $day, $year) && (gmmktime(0, 0, 0, $month, $day, $year) < time())) {
            return true;
        }
        
        return false;
         
    }
}
