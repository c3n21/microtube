<?php

namespace App\Jobs;

use App\Mixins\AddWatermarkToVideo;
use App\Models\Video;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;

class VideoWatermark implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private Video $video,
        private string $filePathname,
        private AddWatermarkToVideo $addWatermarkToVideo
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $pathname = $this->filePathname;
            $target = "{$this->video->getKey()}.mp4";

            $this->addWatermarkToVideo::addWatermarkToVideo($pathname, $target);

            Storage::disk('tmp')->delete($pathname);
        } catch (\Exception $e) {
            throw new \Exception('Error processing video: ' . $e->getMessage());
        }
    }

    /**
     * Get the unique ID for the job.
     */
    public function uniqueId(): string
    {
        return $this->video->getKey();
    }
}
