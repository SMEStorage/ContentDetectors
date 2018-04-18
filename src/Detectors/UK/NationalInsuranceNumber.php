<?php
namespace SME\ContentDetectors\Detectors\UK;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;
use IsoCodes\Uknin as NationalInsuranceNumberValidator;

/**
 * Class NationalInsuranceNumber
 *
 * Detector implementation for UK National Insurance Numbers
 *
 * @package SME\ContentDetectors\Detectors\UK
 * @author James Norman <james@storagemadeeasy.com>
 */
class NationalInsuranceNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'ukNationalInsuranceNumber';
    
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b((?!BG|GB|NK|KN|TN|NT|ZZ)[ABCEGHJ-PRSTW-Z][ABCEGHJ-NPRSTW-Z]?\s*\d{2}\s*\d{2}\s*\d{2}\s*[A-D])\b/umi';
    }

    /**
     * Provides a callback to validate each match found.
     *
     * @param $match
     * @return Match
     */
    public function validateMatch($match)
    {

        $validate = NationalInsuranceNumberValidator::validate($match);

        if (!$validate) {
            return false;
        }

        $result = new Match();
        $result->setMatchType(self::class)
            ->setMatchingContent($match);

        return $result;
    }
}