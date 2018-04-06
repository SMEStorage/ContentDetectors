<?php
namespace SME\ContentDetectors\Detectors;

use SME\ContentDetectors\Match;

/**
 * Interface DetectorInterface
 *
 * Interface that's used for Detectors
 *
 * @package SME\ContentDetectors\Detectors
 */
interface DetectorInterface
{
    /**
     * Returns the regular expression used to initiall detect the content
     *
     * @return string
     */
    public function getRegularExpression();

    /**
     * Provides a callback to validate each match found.
     *
     * @param $match
     * @return false|Match
     */
    public function validateMatch($match);
}