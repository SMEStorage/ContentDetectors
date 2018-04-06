<?php
namespace SME\ContentDetectors\Detectors\UK;

use IsoCodes\PhoneNumber as IsoPhoneNumber;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class UKPhoneNumber
 *
 * Detector implementation for UK Phone Numbers
 *
 * @package SME\ContentDetectors\Detectors
 * @author James Norman <james@storagemadeeasy.com>
 */
class PhoneNumber implements DetectorInterface
{
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/((((\+?44\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3})|((\+44\s?\d{3}|\(?0\d{3}\)?)\s?\d{3}\s?\d{4})|((\+44\s?\d{2}|\(?0\d{2}\)?)\s?\d{4}\s?\d{4}))(\s?\#(\d{4}|\d{3}))?)\b/um';
    }

    /**
     * Provides a callback to validate each match found.
     *
     * @param $match
     * @return Match
     */
    public function validateMatch($match)
    {
        $validate = IsoPhoneNumber::validate($match, 'GB');

        if (!$validate) {
            return false;
        }

        $result = new Match();
        $result->setMatchType(self::class)
            ->setMatchingContent($match);

        return $result;
    }
}