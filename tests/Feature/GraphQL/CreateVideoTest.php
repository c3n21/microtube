<?php

namespace Tests\Feature\GraphQL;

use App\Jobs\VideoWatermark;
use App\Mixins\AddWatermarkToVideo;
use Database\Seeders\UserSeeder;
use GraphQL\Error\Error;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Mockery;

class CreateVideoTest extends GraphQLTestCase
{
    use RefreshDatabase;

    private $testFileName = 'test.mp4';
    private $testMimeType = 'video/mp4';
    private $mutation = 'mutation ($file: Upload!, $title: String!, $user_id: ID!) { createVideo (file: $file, title: $title, user_id: $user_id) { title } } ';
    private $mockedAddToWatermark;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockedAddToWatermark = Mockery::mock(AddWatermarkToVideo::class);
        $this->app->instance(AddWatermarkToVideo::class, $this->mockedAddToWatermark);
        Queue::fake();
    }

    private function generateFile()
    {
        return UploadedFile::fake()->create($this->testFileName, 100, $this->testMimeType);
    }

    private function runMutation(string $title, string  $user_id, \Illuminate\Http\Testing\File $file)
    {
        $map = [
            ['0.variables.file'],
        ];

        return $this->multipartGraphQL([
            [
                'query' => $this->mutation,
                'variables' => [
                    'file' => null,
                    'title' => $title,
                    'user_id' => $user_id,
                ],
            ],
        ], $map, [$file]);
    }

    /**
     * Test error when uploading a video without a valid user id.
     */
    public function test_upload_video_invalid_user(): void
    {
        $this->rethrowGraphQLErrors();
        $this->expectException(Error::class);
        $this->expectExceptionMessage('User not found');

        $this->runMutation('random title', 'NOT EXIST', $this->generateFile())->assertExactJson([]);
    }

    /**
     * When the user exists the video will be updated.
     */
    public function test_upload_video(): void
    {
        Storage::fake('videos');
        $filePathname = '1.tmp';
        $title = 'SUCCESSFULL TEST';
        $testFile = $this->generateFile();
        $this->seed(UserSeeder::class);
        $this->rethrowGraphQLErrors();
        $this->runMutation($title, '1', $testFile);
        $newVideo = $this->graphQL(/** @lang graphql */ <<<QUERY
            query MyQuery {
                videos(title: "$title") {
                    data {
                        title
                        id
                    }
                }
            }
            QUERY);

        $newVideo->assertExactJson([
            'data' => [
                'videos' => [
                    'data' => [
                        [
                            'id' => '1',
                            'title' => $title,
                        ],
                    ],
                ],
            ],
        ]);

        Queue::assertPushed(VideoWatermark::class);

        /**
         * for some reason this throws an error
         */
        Storage::disk('videos')->assertExists($filePathname);
    }
}
