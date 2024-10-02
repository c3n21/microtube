<?php

namespace App\Jobs;

use App\Console\Commands\AddWatermarkToVideo;
use App\Models\Video;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class VideoWatermark implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private Video $video,
        private UploadedFile $file,
        private AddWatermarkToVideo $addWatermarkToVideo
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $pathname = $this->file->getPathname();

            $this->addWatermarkToVideo::addWatermarkToVideo($pathname, $this->video->getKey());

            File::delete($pathname);
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
