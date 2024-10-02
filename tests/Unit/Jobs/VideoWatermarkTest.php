<?php

namespace Tests\Unit\Jobs;

use Tests\TestCase;
use App\Models\Video;
use Illuminate\Http\UploadedFile;
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
        $filePathname = "/path/to/temp/$filename";
        $expectedFilename = 'video_key'; // this is also the video key

        // Mock the Video model
        $videoMock = Mockery::mock(Video::class);
        $videoMock->shouldReceive('getKey')
            ->andReturn($expectedFilename); // Mock the video key

        // Mock the UploadedFile
        $uploadedFileMock = Mockery::mock(UploadedFile::class);
        $uploadedFileMock->shouldReceive('getPathname')
            ->andReturn($filePathname); // Mock the temp file path

        // Mock the Storage disk for 'videos'
        Storage::fake('videos');

        Storage::disk('videos')->assertMissing($expectedFilename);

        // Mock the static AddWatermarkToVideo method
        $addWatermarkMock = Mockery::mock(\App\Console\Commands\AddWatermarkToVideo::class);
        $addWatermarkMock->shouldReceive('addWatermarkToVideo')
            ->with('/path/to/temp/video.mp4', 'video_key')
            ->andReturnUsing(function ($pathname, $videoKey) {
                // Create a dummy MP4 file in the 'videos' disk
                Storage::disk('videos')->put($videoKey, 'dummy content');
            })
            ->once();

        // Mock file deletion
        File::shouldReceive('delete')
            ->with($filePathname)
            ->once();

        // Create the job instance

        $job = new \App\Jobs\VideoWatermark($videoMock, $uploadedFileMock, $addWatermarkMock);

        // Call the handle method
        $job->handle();

        // Assert that the dummy MP4 file was saved in the 'videos' disk
        Storage::disk('videos')->assertExists($expectedFilename);

        // Assert that the uploaded file was deleted
        File::shouldHaveReceived('delete')
            ->with($filePathname)
            ->once();
    }
}
