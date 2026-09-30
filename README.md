# Seedance PHP SDK for RunAPI

[![Packagist](https://img.shields.io/packagist/v/runapi-ai/seedance)](https://packagist.org/packages/runapi-ai/seedance)
[![License](https://img.shields.io/github/license/runapi-ai/seedance-php)](https://github.com/runapi-ai/seedance-php/blob/main/LICENSE)

The Seedance PHP SDK is the language-specific package for Seedance
on RunAPI. Use this package when your application needs Composer installs,
associative-array request bodies, task status lookup, and consistent RunAPI
errors in PHP.

This README is the PHP package guide for the public `seedance-php` split
repository. For model details, use https://runapi.ai/models/seedance; for API
reference, use https://runapi.ai/docs/api/seedance/text-to-video; for SDK docs, use
https://runapi.ai/docs/resources/sdks.

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
    'model' => 'seedance-1.5-pro',
    'aspect_ratio' => '1:1',
    'duration_seconds' => 5,
    'enable_safety_checker' => true,
    'first_frame_image_url' => 'https://cdn.runapi.ai/public/samples/image.jpg',
    'generate_audio' => true,
    'last_frame_image_url' => 'https://cdn.runapi.ai/public/samples/image.jpg',
    'lock_camera' => true,
    'output_format' => 'mp4',
    'output_resolution' => '720p',
    'prompt' => 'A precise product render on white marble',
    'reference_audio_urls' => ['sample'],
    'reference_image_urls' => ['https://cdn.runapi.ai/public/samples/image.jpg'],
    'reference_video_urls' => ['sample'],
    'return_last_frame' => true,
    'seed' => 1,
    'source_image_urls' => ['https://cdn.runapi.ai/public/samples/image.jpg'],
    'web_search' => true,
]);

$status = $client->textToVideo->get($task->id);

$result = $client->textToVideo->run([
    'model' => 'seedance-1.5-pro',
    'aspect_ratio' => '1:1',
    'duration_seconds' => 5,
    'enable_safety_checker' => true,
    'first_frame_image_url' => 'https://cdn.runapi.ai/public/samples/image.jpg',
    'generate_audio' => true,
    'last_frame_image_url' => 'https://cdn.runapi.ai/public/samples/image.jpg',
    'lock_camera' => true,
    'output_format' => 'mp4',
    'output_resolution' => '720p',
    'prompt' => 'A serene mountain lake at dawn',
    'reference_audio_urls' => ['sample'],
    'reference_image_urls' => ['https://cdn.runapi.ai/public/samples/image.jpg'],
    'reference_video_urls' => ['sample'],
    'return_last_frame' => true,
    'seed' => 1,
    'source_image_urls' => ['https://cdn.runapi.ai/public/samples/image.jpg'],
    'web_search' => true,
]);

echo $result->videos[0]->url . PHP_EOL;
```

Use `create()` to submit a task and return quickly, `get()` to fetch the latest
task state, and `run()` when a script should create and poll until completion.
In web request handlers, prefer `create()` plus webhook or later `get()`
polling so a worker is not held open.


RunAPI-generated file URLs are temporary. Download and store generated files
in your own durable storage within the retention window; do not treat returned
URLs as long-term assets.

## Language notes

Pass request parameters as associative arrays with snake_case keys. The
available resources are `textToVideo`. Keep `RUNAPI_API_KEY` in the environment
or your secret manager; never commit API keys or callback secrets.

## Links

- Model page: https://runapi.ai/models/seedance
- SDK docs: https://runapi.ai/docs/resources/sdks
- Product docs: https://runapi.ai/docs/api/seedance/text-to-video
- Pricing and rate limits: https://runapi.ai/models/seedance/v1-pro
- Full catalog: https://runapi.ai/models
- GitHub repository: https://github.com/runapi-ai/seedance-php
- Multi-language SDK repository: https://github.com/runapi-ai/seedance-sdk

## License

Licensed under the Apache License, Version 2.0.
