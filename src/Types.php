<?php

declare(strict_types=1);

namespace RunApi\Seedance;

/**
 * Constants for model slugs supported by the Seedance PHP SDK.
 */
final class Types
{
    /** @var list<string> */
    public const TEXT_TO_VIDEO_MODELS = [
        'seedance-1.5-pro',
        'seedance-2.0',
        'seedance-2.0-fast',
        'seedance-2-mini',
        'seedance-v1-pro',
        'seedance-v1-pro-fast',
    ];

    private function __construct()
    {
    }
}
