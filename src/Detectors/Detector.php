<?php
namespace SME\ContentDetectors\Detectors;

use SME\ContentDetectors\DataMatch;


/**
 * Class Detector 
 *
 * Base class for Detectors
 *
 * @package SME\ContentDetectors\Detectors
 */
class Detector  
{
    
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = '';
    
    /**
     * Returns the detector unique code (ID)
     *
     * @return string
     */
    public function getCode() {
        if (empty($this->code)) {
            throw new \Exception(sprintf('Code is not set for class "%s"', self::class));
        }
        return $this->code;
    }
    
    /**
     * Returns list of regexes (DetectorNextRule) what will be used for validation with AND condition 
     * to regex from getRegularExpression() and OR condition between themself
     *
     * @return array
     */
    public function getDefaultNext()
    {
        return array();
    }
    
    
    /**
     * Provides a callback to validate each match found.
     *
     * @param $match
     * @return DataMatch
     */
    public function validateMatch($match)
    {
        /*
         * no algorithm validation for provided 
         * $match in this code
         */
        
        $valid = $this->validate($match);
        
        if (! $valid) {
            return false;
        }
          
        $result = new DataMatch();
        $result->setMatchType(static::class)
        ->setMatchingContent($match);
    
        return $result;
    }
    
    /**
     * Provides a function to validate found match.
     *
     * @param $match
     * @return bool
     */
    
    protected function validate($match)
    {
        return true;
    }
     
}
   
