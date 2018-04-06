<?php
namespace SME\ContentDetectors\Detectors\Spain;

use IsoCodes\Nif;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;

/**
 * Class NifNumber
 *
 * Detector implementation for Spanish Nif Numbers
 *
 * @package SME\ContentDetectors\Detectors\Spain
 * @author James Norman <james@storagemadeeasy.com>
 */
class NifNumber implements DetectorInterface
{
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b((\d{8}[ -]?[A-Z]{1})|([KLM]\d{7}[ -]?[TRWAGMYFPDXBNJZSQVHLCKE]{1}))\b/umi';
    }

    /**
     * Provides a callback to validate each match found.
     *
     * @param $match
     * @return Match
     */
    public function validateMatch($match)
    {
        $validate = Nif::validate($match);

        if (!$validate) {
            return false;
        }

        $result = new Match();
        $result->setMatchType(self::class)
            ->setMatchingContent($match);

        return $result;
    }
}