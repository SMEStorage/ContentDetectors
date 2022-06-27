<?php
namespace SME\ContentDetectors\Detectors\UK;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;
use SME\ContentDetectors\DataMatch;
use libphonenumber\PhoneNumberUtil;

/**
 * Class UKPhoneNumber
 *
 * Detector implementation for UK Phone Numbers
 *
 * @package SME\ContentDetectors\Detectors
 * @author James Norman <james@storagemadeeasy.com>
 */
class PhoneNumber extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'ukTelephone';
    
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
     * Validate UK Phone Numbers
     *
     * @param string
     * @return bool
     */
    protected function validate($match)
    {
        try {
            $phoneUtil = PhoneNumberUtil::getInstance();
            $phoneObj = $phoneUtil->parse($match, 'GB');
            
            return $phoneUtil->isValidNumber($phoneObj);
        } catch (\Exception $ex) {
            
        }
        
        return false;
    }
    
     
}
