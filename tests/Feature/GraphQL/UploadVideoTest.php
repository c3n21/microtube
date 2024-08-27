<?php

namespace Tests\Feature\GraphQL;

use Database\Seeders\UserSeeder;
use GraphQL\Error\Error;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadVideoTest extends GraphQLTestCase
{
    use RefreshDatabase;

    /**
     * Test error when uploading a video without a valid user id.
     */
    public function test_upload_video_invalid_user(): void
    {
        $this->rethrowGraphQLErrors();
        $this->expectException(Error::class);
        $this->expectExceptionMessageMatches('/^SQLSTATE\[23000\]: Integrity constraint violation: 19 FOREIGN KEY .*/');
        $this->graphQL(/** @lang graphql */ '
            mutation MyMutation {
                uploadVideo(title: "RANDOM TITLE", user_id: "INVALID_USER_ID") {
                    title
                }
            }
        ');

    }

    /**
     * When the user exists the video will be updated.
     */
    public function test_upload_video(): void
    {
        $title = 'random title';

        $this->seed(UserSeeder::class);
        $this->rethrowGraphQLErrors();
        $this->graphQL(/** @lang graphql */ <<<QUERY
            mutation MyMutation {
                uploadVideo(title: "$title", user_id: "1") {
                    title
                }
            }
            QUERY)->assertExactJson([
                'data' => [
                    'uploadVideo' => [
                        'title' => $title
                    ]
                ]
            ]);

        $this->graphQL(/** @lang graphql */ <<<QUERY
            query MyQuery {
                videos(title: "$title") {
                    data {
                        title
                    }
                }
            }
            QUERY)->assertExactJson([
                'data' => [
                    'videos' => [
                        'data' => [
                            [
                                'title' => $title
                            ]
                        ]
                    ]
                ]
            ]);
    }
}
