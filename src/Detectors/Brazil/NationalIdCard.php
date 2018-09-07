<?php
namespace SME\ContentDetectors\Detectors\Brazil;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class NationalIdCard
 *
 * Detector implementation for Brazilian National Identification Card (RG - Registro Geral, Carteira de identidade)
 * https://en.wikipedia.org/wiki/Brazilian_identity_card
 *
 * @package SME\ContentDetectors\Detectors\Brazil
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NationalIdCard extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'brNationalIdCard';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{2}[\- \.]?\d{3}[\- \.]?\d{3}[\- \.]?\d{2}[\- \.]?\d?)\b/um';
    }
  
}