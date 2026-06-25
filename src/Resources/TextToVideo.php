<?php

declare(strict_types=1);

namespace RunApi\Seedance\Resources;

use RunApi\Core\Http\HttpClient;
use RunApi\Core\Models\TaskCreateResponse;
use RunApi\Core\RequestOptions;
use RunApi\Core\Resources\TypedConfiguredResource;
use RunApi\Seedance\Models\CompletedVideoTaskResponse;
use RunApi\Seedance\Models\VideoTaskResponse;
use RunApi\Seedance\Types;

/**
 * Generates videos from text prompts, optionally conditioned on reference images, frame images, reference videos, or audio. The same endpoint handles pure text-to-video and image-to-video depending on which image/video fields are populated in the params.
 */
readonly class TextToVideo extends TypedConfiguredResource
{
    /**
     * Submits an asynchronous video generation task and returns immediately with a task id. Poll with get() or use run() for automatic polling.
     *
     * @param array{
     *   model: string,
     *   prompt?: string,
     *   callback_url?: string,
     *   aspect_ratio?: string,
     *   duration_seconds?: int,
     *   output_resolution?: string,
     *   first_frame_image_url?: string,
     *   last_frame_image_url?: string,
     *   source_image_urls?: list<string>,
     *   reference_audio_urls?: list<string>,
     *   reference_image_urls?: list<string>,
     *   reference_video_urls?: list<string>
     * } $params
     */
    public function create(array $params, ?RequestOptions $options = null): TaskCreateResponse
    {
        return parent::create($params, $options);
    }

    /**
     * Retrieves the current status and results of a video generation task by id.
     */
    public function get(string $id, ?RequestOptions $options = null): VideoTaskResponse
    {
        $response = parent::get($id, $options);

        /** @var VideoTaskResponse $response */
        return $response;
    }

    /**
     * Submits a video generation task and polls until completion, returning the finished result. This is a convenience wrapper around create()/get() polling.
     *
     * @param array{
     *   model: string,
     *   prompt?: string,
     *   callback_url?: string,
     *   aspect_ratio?: string,
     *   duration_seconds?: int,
     *   output_resolution?: string,
     *   first_frame_image_url?: string,
     *   last_frame_image_url?: string,
     *   source_image_urls?: list<string>,
     *   reference_audio_urls?: list<string>,
     *   reference_image_urls?: list<string>,
     *   reference_video_urls?: list<string>
     * } $params
     */
    public function run(array $params, ?RequestOptions $options = null): CompletedVideoTaskResponse
    {
        $response = parent::run($params, $options);

        /** @var CompletedVideoTaskResponse $response */
        return $response;
    }

    /**
     * Create the resource using the shared RunAPI HTTP transport.
     */
    public static function fromHttp(HttpClient $http): self
    {
        return new self(
            $http,
            '/api/v1/seedance/text_to_video',
            'seedance/text-to-video',
            VideoTaskResponse::class,
            CompletedVideoTaskResponse::class,
            Types::TEXT_TO_VIDEO_MODELS,
            'text-to-video',
            VideoTaskResponse::class,
            CompletedVideoTaskResponse::class,
        );
    }
}
