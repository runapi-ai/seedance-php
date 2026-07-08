<?php

declare(strict_types=1);

namespace RunApi\Seedance\Tests\Unit;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use RunApi\Core\ClientOptions;
use RunApi\Core\Errors\ValidationException;
use RunApi\Core\Tests\Fixtures\QueueHttpClient;
use RunApi\Seedance\Models\CompletedVideoTaskResponse;
use RunApi\Seedance\Resources\TextToVideo;
use RunApi\Seedance\SeedanceClient;

final class SeedanceClientTest extends TestCase
{
    public function testExposesTypedResources(): void
    {
        $client = new SeedanceClient(new ClientOptions(apiKey: 'k', httpClient: new QueueHttpClient([]), maxRetries: 0));

        self::assertInstanceOf(TextToVideo::class, $client->textToVideo);
    }

    public function testTextToVideoCreate(): void
    {
        $transport = new QueueHttpClient([new Response(200, [], '{"id":"task_1"}')]);
        $client = new SeedanceClient(new ClientOptions(apiKey: 'k', httpClient: $transport, maxRetries: 0));

        self::assertSame('task_1', $client->textToVideo->create([
            'model' => 'seedance-2.0',
            'prompt' => 'A cat walking through a garden',
        ])->id);
        self::assertSame('/api/v1/seedance/text_to_video', $transport->requests[0]->getUri()->getPath());
    }

    public function testTextToVideoCreateMini(): void
    {
        $transport = new QueueHttpClient([new Response(200, [], '{"id":"task_mini"}')]);
        $client = new SeedanceClient(new ClientOptions(apiKey: 'k', httpClient: $transport, maxRetries: 0));

        self::assertSame('task_mini', $client->textToVideo->create([
            'model' => 'seedance-2-mini',
            'prompt' => 'A compact cinematic scene',
            'reference_video_urls' => ['https://storage.googleapis.com/gtv-videos-bucket/sample/ForBiggerJoyrides.mp4'],
            'reference_audio_urls' => ['https://cdn.runapi.ai/public/samples/audio.mp3'],
            'output_resolution' => '720p',
            'aspect_ratio' => 'auto',
            'duration_seconds' => 8,
            'generate_audio' => false,
        ])->id);
    }

    public function testTextToVideoRunReturnsTypedCompletedResponse(): void
    {
        $transport = new QueueHttpClient([
            new Response(200, [], '{"id":"task_1"}'),
            new Response(200, [], '{"id":"task_1","status":"completed","videos":[{"url":"https://file.runapi.ai/video.mp4"}]}'),
        ]);
        $client = new SeedanceClient(new ClientOptions(apiKey: 'k', httpClient: $transport, maxRetries: 0));

        $result = $client->textToVideo->run([
            'model' => 'seedance-2.0',
            'prompt' => 'A cat walking through a garden',
        ]);

        self::assertInstanceOf(CompletedVideoTaskResponse::class, $result);
        self::assertSame('https://file.runapi.ai/video.mp4', $result->videos[0]->url);
    }

    public function testGeneratedContractValidationRuns(): void
    {
        $client = new SeedanceClient(new ClientOptions(apiKey: 'k', httpClient: new QueueHttpClient([]), maxRetries: 0));

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('duration_seconds must be greater than or equal to 4');

        $client->textToVideo->create([
            'model' => 'seedance-1.5-pro',
            'prompt' => 'test',
            'duration_seconds' => 3,
        ]);
    }
}
