<?php
namespace SME\ContentDetectors\Detectors\Bank;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;

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
    protected static $validator = null;

    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'creditcard';


    public function __construct() 
    {
        if (!self::$validator) {
            self::$validator = new \Validate_Finance_CreditCard();
        }
    }
    
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
     * @return false|DataMatch
     */
    public function validateMatch($match)
    {
        if (! self::$validator->number($match)) {
            return false;
        }

        $result = new DataMatch();
        $result->setMatchType(self::class)
            ->setMatchingContent($match);

        return $result;
    }
}
