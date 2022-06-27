<?php
namespace SME\ContentDetectors\Detectors\Bank;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;
use \IBAN as IbanAccountNumberValidator;

/**
 * Class IbanAccountNumber
 *
 * Detector implementation for IBAN Account Numbers
 *
 * @package SME\ContentDetectors\Detectors\Bank
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class IbanAccountNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'bankIban';
    
   
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([a-z]{2}[0-9]{2}[ -]?([a-z0-9]{4}[ -]?){3,6}[a-z0-9]{0,4})\b/uim';
    }

    /**
     * Validate IBAN Account Numbers
     * 
     * @param string
     * @return bool
     */
     
    protected function validate($match)
    {
        $validator = new \CMPayments\IBAN(preg_replace("/[^\dA-Z]/ui", "", $match));
        
        return $validator->validate();
    }
    
    
}
