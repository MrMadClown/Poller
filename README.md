# Poller [![Build Status](https://travis-ci.org/MrMadClown/Poller.svg?branch=master)](https://travis-ci.org/MrMadClown/Poller)

## Installation
```bash
composer require mrmadclown/poller
```
##Usage
```php
use MrMadClown\Poller\TimedPoller;

$poller = new TimedPoller(1, 10);

$result = $poller->run(function (){
    return $this->checkSomeThingMaybeMakeAnHTTPCall();
});
```
