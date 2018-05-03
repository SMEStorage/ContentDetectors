<?php
namespace SME\ContentDetectors\Detectors;

/**
 * Class Detector 
 *
 * Base class for Detectors
 *
 * @package SME\ContentDetectors\Detectors
 */
class DetectorNextRule  
{

    /**
     * regex for rule
     * @var string
     */
    
   private $_regex = '';
   
   /**
    * name for rule, not mandatory
    * @var string
    */
   
   private $_name = '';
    
   /**
    * 
    * @param string $regex
    * @param string $name
    */
   public function __construct($regex, $name = '') {
       $this->_name = $name;
       $this->_regex = $regex;
   }
   
   /**
    * Get name of rule
    * 
    * @return string
    */
   public function getName() {
       return $this->_name;
   }
   
   /**
    * Get regex of rule
    *
    * @return string
    */
   public function getRegex() {
       return $this->_regex;
   }
}