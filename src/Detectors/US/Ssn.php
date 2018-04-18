<?php
namespace SME\ContentDetectors\Detectors\US;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class Ssn
 *
 * Detector implementation for US SSN
 *
 * @package SME\ContentDetectors\Detectors\US
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Ssn extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'usSsn';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(((?!219-09-9999|078-05-1120)(?!666|000|9\d{2})\d{3}-(?!00)\d{2}-(?!0{4})\d{4})|((?!219 09 9999|078 05 1120)(?!666|000|9\d{2})\d{3}\s*(?!00)\d{2}\s*(?!0{4})\d{4}))\b/um';
    }
 
}