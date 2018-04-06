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
        Detectors\UKPhoneNumber::class,
        Detectors\GenericCreditCard::class
    ];

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