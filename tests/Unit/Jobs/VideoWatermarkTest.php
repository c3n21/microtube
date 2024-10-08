<?php

namespace Tests\Unit\Jobs;

use Tests\TestCase;
use App\Models\Video;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mockery;

class VideoWatermarkTest extends TestCase
{
    /**
     * Test that the uploaded file gets deleted after processing.
     */
    public function test_uploaded_file_gets_deleted_after_processing()
    {
        $filename = 'video.mp4';
        // file uploaded location
        $filePathname = "/path/to/temp/$filename";
        $videoKey = 'video_key';
        $expectedFilename = "$videoKey.mp4"; // this is also the video key

        // Mock the Video model
        $videoMock = Mockery::mock(Video::class);
        $videoMock->shouldReceive('getKey')
            ->andReturn($videoKey); // Mock the video key

        // Mock the UploadedFile
        $uploadedFileMock = $filePathname;

        // Mock the Storage disk for 'videos'
        Storage::fake('videos');

        Storage::disk('videos')->assertMissing($expectedFilename);

        // Mock the static AddWatermarkToVideo method
        $addWatermarkMock = Mockery::mock(\App\Console\Commands\AddWatermarkToVideo::class);
        $addWatermarkMock->shouldReceive('addWatermarkToVideo')
            ->with($filePathname, $expectedFilename)
            ->andReturnUsing(function () use ($expectedFilename) {
                // Create a dummy MP4 file in the 'videos' disk
                Storage::disk('videos')->put($expectedFilename, 'dummy content');
            })
            ->once();


        // Create the job instance

        $job = new \App\Jobs\VideoWatermark($videoMock, $uploadedFileMock, $addWatermarkMock);

        // Call the handle method
        $job->handle();

        // Assert that the dummy MP4 file was saved in the 'videos' disk
        Storage::disk('videos')->assertExists($expectedFilename);
        Storage::disk('videos')->assertMissing($filePathname);
    }
}
