# Content Detectors
This is a PHP package created by the [Storage Made Easy](https://storagemadeeasy.com) team, that provides built in detectors to find specific types of content within a given content string

These content detectors are used as part of Storage Made Easy's [Content Detection and PII Discovery features](https://storagemadeeasy.com/GDPR/). Changes made here are pulled in up-stream to the Enterprise File Fabric. 

## Requirements

- PHP 5.6 or newer
- [PHP Composer](https://getcomposer.org/)
- change your composer.json to contain:
   "repositories":[
      {
          "type": "vcs",
          "url": "https://github.com/bystones/nhs-validator"
      }
   ]


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

## Contributing to the project

All contributions to this project are welcome, and should be done through Pull Requests. 

To contribute you'll first need to clone the repository.

````bash
git clone git@github.com:SMEStorage/ContentDetectors.git
````

Move into the code directory

```
cd ContentDetectors
```

Install Composer dependencies 

```
composer install
```

To create a new Detector, open up the `src/Detectors` directory. Find an example detector like the Germany Passport detector (located at `src/Detectors/Germany/Passoport.php`), and clone this. We aim to keep all detectors under a specific group to make them easier to find, for example the `Germany`, `UK` or `Bank` groups. 

Any detector that you make should implement the DetectorInterface. This specifies two methods, `getRegularExpression` and `validateMatch`.

The `getRegularExpression` method of your detector is called by the `DetectionManager` and should return a PCRE compatible regular expression. This regular expression is used to identify either exact or potential matches. You need to supply the Regular Expression flags. An example of this method for Credit Cards could be implemented as:

````php
public function getRegularExpression()
{
    return '/\b((\d[ -]*){13,19})\b/um';
}
````

The `validateMatch` method is used as a callback for each match that is identified from the regular expression. This method provides you with an opportunity to validate the data that is matched. For example in the Credit Card context, you could use this to validate that the 13 to 19 digits that matched the regular expression is an actual credit card. In this method you can call external methods and services to validate the data. An example of using an external library would be:

````php
public function validateMatch($match)
{
    $info = GenericCreditCardValidator::validCreditCard($match);

    if(is_array($info) && array_key_exists('valid', $info) && $info['valid'] !== true) {
        return false;
    }

    $result = new Match();
    $result->setMatchType(self::class)
        ->setMatchingContent($match)
        ->setData([
            'type' => $info['type']
        ]);

    return $result;
}
````

In the example above, we are using an external library to validate the Credit Card, and then we are also supplying some additional metadata along with the match. In our case, when we find a Credit Card, we return a 'type' field that tells the client what type of Credit Card it is, e.g. Visa or Matercard. 
