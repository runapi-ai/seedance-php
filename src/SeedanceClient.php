<?php

declare(strict_types=1);

namespace RunApi\Seedance;

use RunApi\Core\BaseClient;
use RunApi\Core\ClientOptions;
use RunApi\Seedance\Resources\TextToVideo;

/**
 * The Seedance video generation API client.
 *
 * Exposes typed model resources plus the universal files and account resources.
 */
final class SeedanceClient extends BaseClient
{
    /**
     * Provides video generation operations.
     */
    public readonly TextToVideo $textToVideo;

    /**
     * Create a Seedance client with optional API key, base URL, and transport overrides.
     */
    public function __construct(ClientOptions $options = new ClientOptions())
    {
        parent::__construct($options);
        $this->textToVideo = TextToVideo::fromHttp($this->http);
    }
}
