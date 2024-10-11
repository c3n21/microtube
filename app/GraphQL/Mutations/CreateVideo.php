<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Mixins\AddWatermarkToVideo;
use App\Jobs\VideoWatermark;
use App\Models\User;
use App\Models\Video;
use GraphQL\Error\Error;
use Nuwave\Lighthouse\Execution\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final readonly class CreateVideo
{
    public function __construct(private AddWatermarkToVideo $addWatermarkToVideo) {}

    /**
     * Return a value for the field.
     *
     * @param  null  $root Always null, since this field has no parent.
     * @param  array{
     *  file: \Illuminate\Http\UploadedFile,
     *  user_id: string,
     * }  $args The field arguments passed by the client.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Shared between all fields.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Metadata for advanced query resolution.
     * @return mixed The result of resolving the field, matching what was promised in the schema
     */
    public function __invoke(null $root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): mixed
    {
        $request = $context->request();
        if (!$request instanceof \Illuminate\Http\Request) {
            throw new \Exception('This query has been run outside of HTTP context');
        }

        $file = $args['file'];

        $user = User::find($args['user_id']);

        if ($user === null) {
            throw new Error('User not found');
        }

        $video = new Video([
            'title' => $args['title'],
        ]);

        $video->user()->associate($user)->save();


        $pathname = "{$video->getKey()}.tmp";

        $file->storeAs('', $pathname, 'tmp');

        VideoWatermark::dispatch($video, $pathname, $this->addWatermarkToVideo);

        return $video;
    }
}
