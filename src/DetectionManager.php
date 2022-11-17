<?php
namespace SME\ContentDetectors;

use SME\ContentDetectors\Detectors\DetectorInterface;

/**
 * Class DetectionManager
 *
 * Provides the functions for detecting the content inside strings.
 *
 * @package SME\ContentDetectors
 * @author James Norman <james@storagemadeeasy.com>
 */
class DetectionManager
{
    private $registeredDetectors = [
        Detectors\Australia\MedicareNumber::class,
        Detectors\Australia\TaxFileNumber::class,
        
        Detectors\Bank\GenericCreditCard::class,
        Detectors\Bank\IbanAccountNumber::class,
        Detectors\Bank\RoutingTransitNumber::class,
        Detectors\Bank\SwiftCode::class,
         
        Detectors\Belgium\NationalNumber::class,
        Detectors\Belgium\NationalRegisterNumber::class,
         
        Detectors\Brazil\CpfNumber::class,
        Detectors\Brazil\LegalEntityNumber::class,
        Detectors\Brazil\NationalIdCard::class,
        
        Detectors\Canada\BritishColumbiaInsuranceNumber::class,
        Detectors\Canada\OntarioInsuranceNumber::class,
        Detectors\Canada\Passport::class,
        Detectors\Canada\QuebecInsuranceNumber::class,
        Detectors\Canada\SocialInsuranceNumber::class,
        
        Detectors\Chile\NationalIdNumber::class,
        
        Detectors\China\Passport::class,

        Detectors\Croatia\PersonalIdentificationNumber::class,
        
        Detectors\CzechRepublic\NationalIdCard::class,
        
        Detectors\Denmark\PersonalIdNumber::class,
         
        Detectors\France\INSEENumber::class,
        Detectors\France\NationalIdCard::class,
        Detectors\France\Passport::class,
        
        Detectors\Germany\Passport::class,
        
        Detectors\India\PermanentAccountNumber::class,
        
        Detectors\Israel\NationalIdNumber::class,
         
        Detectors\Japan\Passport::class,
        
        Detectors\Mexico\NationalNumber::class,
        Detectors\Mexico\Passport::class,
          
        Detectors\Misc\Copyright::class,
        Detectors\Misc\Coordinates::class,
        Detectors\Misc\Cusip::class,
        Detectors\Misc\Date::class,
        Detectors\Misc\Email::class,
        Detectors\Misc\Icd10cm::class,
        Detectors\Misc\Icd9cm::class,
        Detectors\Misc\Ip::class,
        Detectors\Misc\PotentialPassword::class,
        Detectors\Misc\Swearword::class,
         
        Detectors\Netherlands\IdNumber::class,
        
        Detectors\NewZealand\HealthNumber::class,
        
        Detectors\Norway\NationalIdNumber::class,
        
        Detectors\Poland\NationalIdCard::class,
        Detectors\Poland\NationalIdNumber::class,
        Detectors\Poland\Passport::class,
        
        Detectors\Singapore\NationalIdCard::class,
         
        Detectors\SouthAfrica\NationalIdNumber::class,
         
        Detectors\SouthKorea\Passport::class,
         
        Detectors\Spain\NieNumber::class,
        Detectors\Spain\NifNumber::class,
        Detectors\Spain\Passport::class,
        
        Detectors\Sweden\NationalIdNumber::class,
        Detectors\Sweden\Passport::class,
         
        Detectors\Taiwan\NationalIdCard::class,
        
        Detectors\UK\DrivingLicense::class,
        Detectors\UK\NationalInsuranceNumber::class,
        Detectors\UK\NhsNumber::class,
        Detectors\UK\Passport::class,
        Detectors\UK\PhoneNumber::class,
        Detectors\UK\PlateNumber::class,
        Detectors\UK\PostCode::class,
        Detectors\UK\TaxpayerNumber::class,
         
        Detectors\US\DrivingLicenseNumber::class,
        Detectors\US\DeaNumber::class,
        Detectors\US\Ssn::class,
        Detectors\US\Zip::class,
        Detectors\US\Passport::class
    ];

    public function enableDetector($type)
    {
        if (!class_exists($type)) {
            throw new MissingDetectorException(sprintf('Detector not found "%s"', $type));
        }


        if (!in_array($type, $this->registeredDetectors)) {
            $this->registeredDetectors[] = $type;

            return true;
        }

        return false;
    }

    public function disableDetector($type)
    {
        if (!class_exists($type)) {
            throw new MissingDetectorException(sprintf('Detector not found "%s"', $type));
        }

        $this->registeredDetectors = array_filter($this->registeredDetectors, function($item) use ($type) {
            return $item != $type;
        });
    }

    public function getDetectors()
    {
        return $this->registeredDetectors;
    }

    /**
     * Returns detector class by code
     *
     * @param $code
     * @return string
     */
    public function getDetectorByCode($code)
    {
        $detectorClassResult = null;
        
        foreach ($this->registeredDetectors as $detectorClass) {
            /** @var DetectorInterface $detector */
            $detector = new $detectorClass;
            if ($detector->getCode() == $code) {
                $detectorClassResult = $detectorClass;
                break;
            }
        }
        
        return $detectorClassResult;
    }
    
    /**
     * Returns the types of matching content on the given content string
     *
     * @param $content
     * @param DetectorInterface $filterClass
     * @return MatchCollection
     */
    public function getMatchingTypes($content, $filterClass = null)
    {
        $matchCollection = new MatchCollection();

        foreach ($this->registeredDetectors as $detectorClass) {
            if ($filterClass && ($filterClass != $detectorClass)) {
                continue;
            }
            /** @var DetectorInterface $detector */
            $detector = new $detectorClass;
            $matches = [];

            if (preg_match_all($detector->getRegularExpression(), $content, $matches)) {
                $matches = array_unique($matches[0]);
                $matches = array_values($matches);
            }

            $countMatches = count($matches);
            for ($i = 0; $i < $countMatches; $i++) {
                // If the match is empty, remove it.
                if (empty($matches[$i])) {
                    continue;
                }

                $validateResult = $detector->validateMatch($matches[$i]);

                if (!($validateResult instanceof DataMatch)) {
                    continue;
                }

                // Add this to the DataMatch collection
                $matchCollection->addMatch($validateResult);
            }

        }

        return $matchCollection;
    }
    
    /**
     * Returns matching content for specified type
     *
     * @param $content
     * @param DetectorInterface $filterClass
     * @return MatchCollection
     */
    public function getMatchingByType($content, $filterClass)
    {
         
        if (! class_exists($filterClass)) {
            throw new MissingDetectorException(sprintf('Detector not found "%s"', $filterClass));
        }
        
        return $this->getMatchingTypes($content, $filterClass);
    }

}
