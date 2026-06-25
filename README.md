# Seedance PHP SDK for RunAPI

[![Packagist](https://img.shields.io/packagist/v/runapi-ai/seedance)](https://packagist.org/packages/runapi-ai/seedance)
[![License](https://img.shields.io/github/license/runapi-ai/seedance-php)](https://github.com/runapi-ai/seedance-php/blob/main/LICENSE)

The Seedance PHP SDK is the Composer package for Seedance on RunAPI. Use it when your PHP application needs associative-array request bodies, task status lookup, polling helpers, file helpers, and consistent RunAPI errors.

## Install

```bash
composer require runapi-ai/seedance
```

## Quick start

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use RunApi\Seedance\SeedanceClient;

$client = new SeedanceClient(); // reads RUNAPI_API_KEY

$task = $client->textToVideo->create([
    'model' => 'seedance-2.0',
    'prompt' => 'A cat walking through a garden',
]);

$status = $client->textToVideo->get($task->id);

$result = $client->textToVideo->run([
    'model' => 'seedance-2.0',
    'prompt' => 'A cinematic product reveal with dramatic lighting',
]);

echo $result->videos[0]->url . PHP_EOL;
```

Use `create()` to submit a task and return quickly, `get()` to fetch the latest task state, and `run()` when a script should create and poll until completion. In web request handlers, prefer `create()` plus webhook or later `get()` polling so a worker is not held open.

Returned file URLs are temporary. Download and store generated files in your own durable storage within the retention window.

All SDK exceptions inherit from `RunApi\Core\Errors\RunApiException`, including validation, authentication, rate limit, task failure, and task timeout errors.

## Links

- Model page: https://runapi.ai/models/seedance
- SDK docs: https://runapi.ai/docs#sdk-seedance
- Product docs: https://runapi.ai/docs#seedance
- Pricing and rate limits: https://runapi.ai/models/seedance/v1-lite
- Full catalog: https://runapi.ai/models
- GitHub repository: https://github.com/runapi-ai/seedance-php
- Multi-language SDK repository: https://github.com/runapi-ai/seedance-sdk

## License

Licensed under the Apache License, Version 2.0.
