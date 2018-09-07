<?php
namespace SME\ContentDetectors\Detectors\UK;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\Match;
use \CloudDataService\NHSNumberValidation\Validator as NhsNumberValidator;

/**
 * Class NhsNumber
 *
 * Detector implementation for UK NHS Numbers
 *
 * @package SME\ContentDetectors\Detectors\UK
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class NhsNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'ukNhsNumber';
    
    /**
     * validator
     * @var NieNumberValidator
     */
    
    protected $_validator = null;
    
    
    protected function getValidator() {
        if (! $this->_validator) {
            $this->_validator = new NhsNumberValidator();
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
        return '/\b(\d{3}[- ]?\d{3}[- ]?\d{4})\b/um';
    }

    /**
     * Validate UK NHS Numbers
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
        $valid = false;
        try {
            $valid = $this->getValidator()->validate($match);
        } catch (\Exception $ex) {
             $valid = false;
        }
        
        return $valid ? true : false;
    }
    
    
    
}