<?php
namespace SME\ContentDetectors\Detectors\Brazil;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

/**
 * Class LegalEntityNumber
 *
 * Detector implementation for Brazilian Legal Entity Number (CNPJ - Cadastro Nacional da Pessoa Jurídica)
 * https://en.wikipedia.org/wiki/CNPJ
 *
 * @package SME\ContentDetectors\Detectors\Brazil
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class LegalEntityNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'brLegalEntityNumber';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{2}[\- \.]?\d{3}[\- \.]?\d{3}[\- \.\/]?\d{4}[\- \.]?\d{2})\b/um';
    }

    
    /** based on https://metacpan.org/pod/distribution/Business-BR-Ids/lib/Business/BR/CNPJ.pm
     * 
     * @param string
     * @return bool
     */
     protected function validate($match)
     {
          
        $cnpjNumber = preg_replace("/[^\d]/u", "", $match);
        
        // Check for 14
        $length = strlen($cnpjNumber);
        if ($length == 14) {
            
            $sum1 = 0;
            $weights = array(5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2, 1 , 0);
            foreach ($weights as $position => $weight) {
                $digit = $cnpjNumber[$position];
                $sum1 += $weight * intval($digit);
            }
            $cheknum1 = $sum1 % 11;
            
            if (! (($cheknum1 == 0) || (($cheknum1 == 1) && (intval($cnpjNumber[12]) == 0)))) {
                return false;
            }
           
            
            $sum2 = 0;
            $weights = array(6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2, 1);
            foreach ($weights as $position => $weight) {
                $digit = $cnpjNumber[$position];
                $sum2 += $weight * intval($digit);
            }
            
            $cheknum2 = $sum2 % 11;
            
            if (($cheknum2 == 0) || (($cheknum2 == 1) && (intval($cnpjNumber[13]) == 0))) {
                return true;
            }
        }
        
        return false;
    }
    
}
