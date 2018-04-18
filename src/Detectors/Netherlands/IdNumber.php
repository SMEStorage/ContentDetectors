<?php
namespace SME\ContentDetectors\Detectors\Netherlands;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

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
     * Provides a callback to validate each match found.
     *
     * @param $match
     * @return Match
     */
    public function validateMatch($match)
    {
        $validate = $this->isValidIdNumber($match);

        if (!$validate) {
            return false;
        }

        $result = new Match();
        $result->setMatchType(self::class)
            ->setMatchingContent($match);

        return $result;
    }
    
    
    /**
     * validate Netherlandian Id Number
     *
     * @param string
     * @return bool
     *
     */
    private function isValidIdNumber($value)
    {
        $value = preg_replace("/[^\d]/u", "", $value);
        
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