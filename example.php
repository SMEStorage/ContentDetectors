<?php

require __DIR__ . '/../../../vendor/autoload.php';


$content = '';

$content .= file_get_contents(__DIR__ . '/testdata/AustraliaMedicareNumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/AustraliaTaxFileNumber.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/BankGenericCreditCards.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/BankIbanAccountNumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/BankSwiftCodes.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/BelgiumNationalNumber.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/BelgiumNationalRegisterNumber.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/BrazilCpfNumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/BrazilLegalEntityNumber.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/BrazilNationalIdCard.txt') . "\n";

 
$content .= file_get_contents(__DIR__ . '/testdata/CanadaBritishColumbiaInsuranceNumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/CanadaOntarioInsuranceNumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/CanadaPassports.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/CanadaQuebecInsuranceNumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/CanadaSocialInsuranceNumbers.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/ChileNationalIdNumber.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/ChinaPassports.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/CroatiaPersonalIdentificationNumber.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/CzechRepublicNationalIdCard.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/DenmarkPersonalIdentificationNumber.txt') . "\n";
  
$content .= file_get_contents(__DIR__ . '/testdata/FranceINSEENumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/FranceNationalIdCard.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/FrancePassports.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/GermanyPassports.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/IndiaPermanentAccountNumbers.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/IsraelNationalIdNumber.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/JapanPassports.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/MaxicoPassports.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/MexicoNationalNumbers.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/MiscCoordinates.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/MiscCopyright.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/MiscCusip.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/MiscDate.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/MiscPotentialPasswords.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/MiscSwearword.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/MiscEmails.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/MiscICD-10CMCodes.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/MiscICD-9CMCodes.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/MiscIPs.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/NetherlandsIdNumbers.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/NewZealandHealthNumber.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/NorwayNationalIdNumber.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/PolandNationalIdCard.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/PolandNationalIdNumber.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/PolandPassport.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/SingaporeNationalIdCard.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/SouthAfricaNationalIdNumber.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/SouthKoreaPassports.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/SpainNieNumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/SpainNifNumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/SpainPassports.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/SwedenNationalIdNumber.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/SwedenPassports.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/TaiwanNationalIdNumber.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/UKDrivingLicenses.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/UKNationalInsuranceNumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/UKNHSNumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/UKPassports.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/UKPhoneNumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/UKPlateNumbers.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/UKTaxpayerNumbers.txt') . "\n";

$content .= file_get_contents(__DIR__ . '/testdata/UsDEANumber.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/UsZip.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/UsPassport.txt') . "\n";
$content .= file_get_contents(__DIR__ . '/testdata/UsSSN.txt') . "\n";



$manager = new \SME\ContentDetectors\DetectionManager();

$matches = $manager->getMatchingTypes($content);

echo "Enabled Detectors:\n";
foreach ($manager->getDetectors() as $detector) {
    echo sprintf("----> %s\n", $detector);
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

        $dataString = '(' . http_build_query($data, '', ', ') . ')';
    }

    echo sprintf("Found '%s' '%s' %s\n", $type, $content, $dataString);
}