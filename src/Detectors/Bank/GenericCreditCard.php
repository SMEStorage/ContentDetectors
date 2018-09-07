<?php
namespace SME\ContentDetectors\Detectors\Bank;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;
use Inacho\CreditCard as GenericCreditCardValidator;

/**
 * Class GenericCreditCard
 *
 * Detector implementation for Generic Credit card detection
 *
 * @package SME\ContentDetectors\Detectors\Bank
 * @author James Norman <james@storagemadeeasy.com>
 */
class GenericCreditCard extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'creditcard';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b((\d[ -]*){13,19})\b/um';
    }

    /**
     * Provides a callback to validate each match found.
     *
     * @param string
     * @return false|Match
     */
    public function validateMatch($match)
    {
        $info = GenericCreditCardValidator::validCreditCard($match);

        if (! (is_array($info) && array_key_exists('valid', $info) && ($info['valid'] === true))) {
            return false;
        }

        $result = new Match();
        $result->setMatchType(self::class)
            ->setMatchingContent($match)
            ->setData([
                'type' => $info['type']
            ]);

        return $result;
    }
}