<?php

require __DIR__ . '/vendor/autoload.php';


$content = '';

$content .= file_get_contents(__DIR__ . '/testdata/UKPhoneNumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/UKNationalInsuranceNumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/SpainNifNumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/GenericCreditCards.txt') . "\n";

$manager = new \SME\ContentDetectors\DetectionManager();

$matches = $manager->getMatchingTypes($content);

echo "Enabled Detectors:\n";
foreach ($manager->getDetectors() as $detector) {
    echo sprintf("----> %s\n" , $detector);
}

echo sprintf("\n" , $detector);

echo sprintf("Detecting content in files:\n", $detector);

foreach ($matches as $match) {
    $type = $match->getMatchType();
    $content = $match->getMatchingContent();
    $data = $match->getData();

    $dataString = '';

    if (is_array($data) && count($data)) {
        // For ease of rendering let's filter out on string values.
        $data = array_filter($data, function($value, $key) {
            return is_string($value);
        }, ARRAY_FILTER_USE_BOTH);

        $dataString = '('.  http_build_query($data,'',', ') . ')';
    }

    echo sprintf("Found '%s' '%s' %s\n", $match->getMatchType(), $match->getMatchingContent(), $dataString);
}