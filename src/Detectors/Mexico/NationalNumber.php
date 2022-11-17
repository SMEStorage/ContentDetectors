<?php
namespace SME\ContentDetectors\Detectors\Mexico;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class NationalNumber
 *
 * Detector implementation for Mexican National Numbers (CURP (Clave Única de Registro de Población))
 *
 * @package SME\ContentDetectors\Detectors\Mexico
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NationalNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'mxNationalNumber';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([A-Z]{4}\d{6}[HM]{1}[A-Z]{5}\d{2})\b/uim';
    }
 
}
