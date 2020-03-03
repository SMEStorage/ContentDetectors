<?php
namespace SME\ContentDetectors\Detectors\US;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;

/**
 * Class DrivingLicenseNumber
 *
 * Detector implementation for US Driving License Number
 *
 * @package SME\ContentDetectors\Detectors\US
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class DrivingLicenseNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'usDrLicense';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(((?=.{12}$)[A-Z]{1,7}[A-Z0-9\\*]{4,11})|([A-Z]{1}[0-9]{18})|([0-9]{16})|([A-Z]{8})|([0-9]{2}[A-Z]{3}[0-9]{5})|([0-9]{2}[A-Z]{3}[0-9]{5})|([A-Z]{3}[0-9]{8})|([0-9]{9}[A-Z]{1})|([0-9]{9}[A-Z]{1})|([0-9]{8}[A-Z]{2})|([0-9]{3}[A-Z]{1}[0-9]{6})|([A-Z]{1}[0-9]{6}[R]{1})|([0-9]{7}[A-Z]{1})|([0-9]{1,14})|([A-Z]{1}[0-9]{1,10})|([A-Z]{2}[0-9]{2,5})|([A-Z]{2}[0-9]{7})|([A-Z]{1}[0-9]{11,12})|([A-Z]{1}[0-9]{14})|([A-Z]{2}[0-9]{6}[A-Z]{1})|(([A-Z]{1}[0-9]{1}){2}[A-Z]{1})|([0-9]{7}[A-Z]{1}))\b/um';
    }
}