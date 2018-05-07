<?php
namespace SME\ContentDetectors\Detectors\Spain;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;
use \MPijierro\Identity\Identity as NifNumberValidator;


/**
 * Class NifNumber
 *
 * Detector implementation for Spanish Nif Numbers
 *
 * @package SME\ContentDetectors\Detectors\Spain
 * @author James Norman <james@storagemadeeasy.com>
 */
class NifNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'esNif';
     
    /**
     * validator
     * @var NieNumberValidator
     */
    
    protected $_validator = null;
    
    
    protected function getValidator() {
        if (! $this->_validator) {
            $this->_validator = new NifNumberValidator();
        }
    
        return $this->_validator;
    }
    
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
        $validate = $this->getValidator()->isValidNif($match);
     
        if (!$validate) {
            return false;
        }

        $result = new Match();
        $result->setMatchType(self::class)
            ->setMatchingContent($match);

        return $result;
    }
    
}