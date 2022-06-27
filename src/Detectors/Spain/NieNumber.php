<?php
namespace SME\ContentDetectors\Detectors\Spain;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;
use Skilla\ValidatorCifNifNie\Validator as NieNumberValidator;
use Skilla\ValidatorCifNifNie\Generator as NieNumberGenerator;
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
     * validator
     * @var NieNumberValidator
     */
    
    protected $_validator = null;
    
    
    protected function getValidator() {
        if (! $this->_validator) {
            $this->_validator = new NieNumberValidator(new NieNumberGenerator());
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
        return '/\b([XYZ]\d{7}[ -]?[TRWAGMYFPDXBNJZSQVHLCKE]{1})\b/umi';
    }

    /**
     * Validate Spanish Nie Numbers
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
        $valid = $this->getValidator()->isValidNIE($match);
 
        return $valid ? true : false;
    }
    
   
}
