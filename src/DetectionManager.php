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
        Detectors\UK\PhoneNumber::class,
        Detectors\UK\NationalInsuranceNumber::class,
        Detectors\Spain\NifNumber::class,
        Detectors\GenericCreditCard::class
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
     * Returns the types of matching content on the given content string
     *
     * @param $content
     * @return MatchCollection
     */
    public function getMatchingTypes($content)
    {
        $matchCollection = new MatchCollection();

        foreach ($this->registeredDetectors as $detectorClass) {
            /** @var DetectorInterface $detector */
            $detector = new $detectorClass;
            $matches = [];

            if (preg_match_all($detector->getRegularExpression(), $content, $matches)) {
                $matches = array_unique($matches[0]);
            }

            $countMatches = count($matches);
            for ($i = 0; $i < $countMatches; $i++) {
                // If the match is empty, remove it.
                if (empty($matches[$i])) {
                    continue;
                }

                $validateResult = $detector->validateMatch($matches[$i]);

                if (!($validateResult instanceof Match)) {
                    continue;
                }

                // Add this to the Match collection
                $matchCollection->addMatch($validateResult);
            }

        }

        return $matchCollection;
    }

}