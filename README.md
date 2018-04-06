# Content Detectors
This is a PHP package that can help identify certain types of content from strings. 

## Installation

```
composer require storagemadeeasy/contentdetectors
```

## Usage

````php
<?php

require __DIR__ . '/vendor/autoload.php';
$manager = new \SME\ContentDetectors\DetectionManager();

$matches = $manager->getMatchingTypes($content);
foreach ($matches as $match) {
    // Do something with the match
}
````

## Detectors
This comes with a couple of Detectors, with more to follow. Presently this supports:
- Credit cards
- UK Phone Numbers

The `DetectionManager` provides methods to obtain the list of available Detectors. 

````php
$manager = new \SME\ContentDetectors\DetectionManager();

// Get the enabled detectors
$detectors = $manager->getDetectors();

// Disable a detector
$manager->disableDetector(\SME\ContentDetectors\Detectors\UKPhoneNumber::class);

// Enable a detector 
$manager->enableDetector(\SME\ContentDetectors\Detectors\UKPhoneNumber::class);
````

