<?php
namespace SME\ContentDetectors\Detectors\Spain;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;
use Skilla\ValidatorCifNifNie\Validator as NifNumberValidator;
use Skilla\ValidatorCifNifNie\Generator as NifNumberGenerator;


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
            $this->_validator = new NifNumberValidator(new NifNumberGenerator());
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
     * Validate Spanish Nif Numbers
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
        $valid = $this->getValidator()->isValidNIF($match);
    
        return $valid ? true : false;
    }
   
    
}