<?php
namespace SME\ContentDetectors\Detectors\Spain;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;
use \MPijierro\Identity\Identity as NieNumberValidator;

/**
 * Class NieNumber
 *
 * Detector implementation for Spanish Nie Numbers
 *
 * @package SME\ContentDetectors\Detectors\Spain
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NieNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'esNie';
     
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
        return '/\b([XYZ]\d{7}[ -]?[TRWAGMYFPDXBNJZSQVHLCKE]{1})\b/umi';
    }

    /**
     * Provides a callback to validate each match found.
     *
     * @param $match
     * @return Match
     */
    public function validateMatch($match)
    {
        $validate =  NieNumberValidator::isValidNie($match);

        if (!$validate) {
            return false;
        }

        $result = new Match();
        $result->setMatchType(self::class)
            ->setMatchingContent($match);

        return $result;
    }
    
   
}