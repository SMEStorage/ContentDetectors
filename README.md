# Content Detectors
This is a PHP package created by the [Storage Made Easy](https://storagemadeeasy.com) team, that provides built in detectors to find specific types of content within a given content string

These content detectors are used as part of Storage Made Easy's [Content Detection and PII Discovery features](https://storagemadeeasy.com/GDPR/). Changes made here are pulled in up-stream to the Enterprise File Fabric. 

## Requirements

- PHP 5.6 or newer
- [PHP Composer](https://getcomposer.org/)

## Using this library

```
composer require storagemadeeasy/contentdetectors
```

## Usage

````php
<?php

// Require composer autoload
require __DIR__ . '/vendor/autoload.php';

$manager = new \SME\ContentDetectors\DetectionManager();

$matches = $manager->getMatchingTypes($content);
foreach ($matches as $match) {
    // Get the match type, e.g. Passport Number
    $type = $match->getMatchType();
    
    // Get the string matches 
    $content = $match->getMatchingContent();
    
    // Get any additional metadata about the maches, e.g. Credit card number type like Visa
    $data = $match->getData();
}
````

## Available Content Detectors
There are a number of detectors that this package supports. A list of connectors can be found in the `src/Detectors` directory. 

### Selecting Content Detectors in code
You do not have to use all of the content detectors that ship with this package. The `DetectionManager` class provides some methods for enabling and disabling some of the available content detectors. 

The following is an example of the DetectionManager class interface. 

````php
$manager = new \SME\ContentDetectors\DetectionManager();

// Get the enabled detectors
$detectors = $manager->getDetectors();

// Disable a detector
$manager->disableDetector(\SME\ContentDetectors\Detectors\UKPhoneNumber::class);

// Enable a detector 
$manager->enableDetector(\SME\ContentDetectors\Detectors\UKPhoneNumber::class);
````

