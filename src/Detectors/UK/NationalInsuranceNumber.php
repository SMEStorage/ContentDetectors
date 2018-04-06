<?php
namespace SME\ContentDetectors\Detectors\UK;

use IsoCodes\Uknin;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class NationalInsuranceNumber
 *
 * Detector implementation for UK National Insurance Numbers
 *
 * @package SME\ContentDetectors\Detectors\UK
 * @author James Norman <james@storagemadeeasy.com>
 */
class NationalInsuranceNumber implements DetectorInterface
{
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

        $validate = Uknin::validate($match);

        if (!$validate) {
            return false;
        }

        $result = new Match();
        $result->setMatchType(self::class)
            ->setMatchingContent($match);

        return $result;
    }
}