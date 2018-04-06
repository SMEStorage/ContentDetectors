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
