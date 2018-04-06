<?php
namespace SME\ContentDetectors\Detectors;

use Inacho\CreditCard as CreditCardValidator;
use SME\ContentDetectors\Match;

/**
 * Class GenericCreditCard
 *
 * Detector implementation for Generic Credit card detection
 *
 * @package SME\ContentDetectors\Detectors
 * @author James Norman <james@storagemadeeasy.com>
 */
class GenericCreditCard implements DetectorInterface
{
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
     * @param $match
     * @return false|Match
     */
    public function validateMatch($match)
    {
        $info = CreditCardValidator::validCreditCard($match);

        if(is_array($info) && array_key_exists('valid', $info) && $info['valid'] !== true) {
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