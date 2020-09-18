# Poller 
[![Build Status](https://travis-ci.org/MrMadClown/Poller.svg?branch=master)](https://travis-ci.org/MrMadClown/Poller) 
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)
[![Latest Stable Version](https://poser.pugx.org/mrmadclown/poller/v/stable.svg)](https://packagist.org/packages/mrmadclown/poller)
[![Total Downloads](https://poser.pugx.org/mrmadclown/poller/downloads)](https://packagist.org/packages/mrmadclown/poller)

## Installation
```bash
composer require mrmadclown/poller
```
## Usage
```php
use MrMadClown\Poller\TimedPoller;

$poller = new TimedPoller(1, 10);

$result = $poller->run(function (){
    return $this->checkSomeThingMaybeMakeAnHTTPCall();
});
```
