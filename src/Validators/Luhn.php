<?php
namespace SME\ContentDetectors\Validators;

class Luhn
{
    
    // https://en.wikipedia.org/wiki/Luhn_algorithm
    public function calculate($value)
    {
        $sum = 0;
        $alternate = false;
        for ($i = strlen($value) - 1; $i >= 0; $i --) {
            $n = intval($value[$i]);
            if ($alternate) {
                $n *= 2;
                if ($n > 9) {
                    $n = ($n % 10) + 1;
                }
            }
            $sum += $n;
            $alternate = ! $alternate;
        }
        return ($sum % 10);
    }
}
