<?php
namespace SME\ContentDetectors\Detectors\Brazil;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class CpfNumber
 *
 * Detector implementation for Brazilian Cpf Numbers (Cadastro de Pessoas Físicas)
 *
 * @package SME\ContentDetectors\Detectors\Brazil
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class CpfNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'brCpfNumber';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b(\d{3}[- \.]?\d{3}[- \.]?\d{3}[- \.]?\d{2})\b/um';
    }

    /**
     * Provides a callback to validate each match found.
     *
     * @param $match
     * @return Match
     */
    public function validateMatch($match)
    {
        $validate = $this->validateCpfNumber($match);

        if (!$validate) {
            return false;
        }
         
        $result = new Match();
        $result->setMatchType(self::class)
            ->setMatchingContent($match);

        return $result;
    }
    
    
    /** based on http://search.cpan.org/dist/Business-BR-Ids/lib/Business/BR/CPF.pm code
     * 
     * @param $cpfNumber
     * @return bool
     */
    private function validateCpfNumber($cpfNumber)
    {
         
        $cpfNumber = preg_replace("/[^\d]/u", "", $cpfNumber);
        
        // Check for 11
        $length = strlen($cpfNumber);
        if ($length == 11) {
            
            $sum1 = 0;
            $weights = array(10, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0);
            foreach ($weights as $position => $weight) {
                $digit = $cpfNumber[$position];
                $sum1 += $weight * intval($digit);
            }
            $cheknum1 = $sum1 % 11;
            
            if (! (($cheknum1 == 0) || (($cheknum1 == 1) && (intval($cpfNumber[9]) == 0)))) {
                return false;
            }
            
            $sum2 = 0;
            $weights = array(0, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1);
            foreach ($weights as $position => $weight) {
                $digit = $cpfNumber[$position];
                $sum2 += $weight * intval($digit);
            }
            
            $cheknum2 = $sum2 % 11;
            
            if (($cheknum2 == 0) || (($cheknum2 == 1) && (intval($cpfNumber[11]) == 0))) {
                return true;
            }
        }
        return false;
    }
    
}