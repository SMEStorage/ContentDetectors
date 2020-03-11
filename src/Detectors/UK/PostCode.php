<?php
namespace SME\ContentDetectors\Detectors\UK;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
 
/**
 * Class PlateNumber
 *
 * Detector implementation for UK Post code
 *
 * @package SME\ContentDetectors\Detectors\UK
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class PostCode extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'ukPostCode';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/(\b([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9][A-Za-z]?))))\s?[0-9][A-Za-z]{2})\b)/um';
    }
  
}