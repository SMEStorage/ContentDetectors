<?php
namespace SME\ContentDetectors\Detectors\Netherlands;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class IdNumber
 *
 * Detector implementation for Netherlandian Id Numbers
 *
 * @package SME\ContentDetectors\Detectors\Netherlands
 * @author James Norman <james@storagemadeeasy.com>
 */
class IdNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'nlIdNumber';
     
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{8,9})\b/um';
    }

    /**
     * Validate Netherlandian Id Numbers by checksum
     *
     * @param string
     * @return bool
     */
     
    protected function validate($match)
    {
        $value = preg_replace("/[^\d]/u", "", $match);
        
        // Check for 8 or 9 digits
        $length = strlen($value);
        if (($length == 8) || ($length == 9)) {
            if ($length == 8) {
                $value = '0' . $value;
            }
            // Test checksum
            $sum = 0;
            $weights = array(9, 8, 7, 6, 5, 4, 3, 2, -1);
            foreach ($weights as $position => $weight) {
                $sum += intval($value[$position]) * $weight;
            }
            return (($sum % 11) == 0);
        }
        
        return false;
    }
}
