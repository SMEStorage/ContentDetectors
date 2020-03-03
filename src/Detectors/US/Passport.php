<?php
namespace SME\ContentDetectors\Detectors\US;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
 
/**
 * Class Passport
 *
 * Detector implementation for US Passport
 *
 * @package SME\ContentDetectors\Detectors\US
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Passport extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'usPassport';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(([A-Z0-9]{6-9})|([Cc]\d{8-9}))\b/um';
    }
}