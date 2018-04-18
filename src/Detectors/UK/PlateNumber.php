<?php
namespace SME\ContentDetectors\Detectors\UK;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class PlateNumber
 *
 * Detector implementation for UK Plate Numbers
 *
 * @package SME\ContentDetectors\Detectors\UK
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class PlateNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'ukNumberPlate';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/(\b[A-Z]{2}[0-9]{2}[A-Z]{3}\b)|(\b[A-Z][0-9]{1,3}[A-Z]{3}\b)|(\b[A-Z]{3}[0-9]{1,3}[A-Z]\b)|(\b[0-9]{1,4}[A-Z]{1,2}\b)|(\b[0-9]{1,3}[A-Z]{1,3}\b)|(\b[A-Z]{1,2}[0-9]{1,4}\b)|(\b[A-Z]{1,3}[0-9]{1,3}\b)/umi';
    }
  
}