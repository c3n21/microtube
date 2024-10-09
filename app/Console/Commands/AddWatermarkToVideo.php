<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Add a watermark to the given video file.
 *
 * It's used for testing purposes.
 *
 * Caveats:
 * - since this uses the LaravelFFMpeg package, it only works for files that are under the 'videos' disk.
 */
class AddWatermarkToVideo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-watermark-to-video {filepath} {target}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a watermark to the given video file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(\App\Mixins\AddWatermarkToVideo $addWatermark)
    {
        $filepath = $this->argument('filepath');
        $target = $this->argument('target');

        if (
            !is_string($filepath)
        ) {
            $filepathType = gettype($filepath);
            $this->error("The argument 'filepath' is expected to be 'string' but got '$filepathType' ($filepath)  does not exist.");
            return 1;
        }

        if (
            !is_string($target)
        ) {
            $targetType = gettype($target);
            $this->error("The argument 'target' is expected to be 'string' but got '$targetType' ($target)  does not exist.");
            return 1;
        }

        try {
            $addWatermark->addWatermarkToVideo($filepath, $target);

            $this->info("Watermark added successfully to {$filepath}.");
            return 0;
        } catch (\Exception $e) {
            $this->error("An error occurred: " . $e->getMessage());
            return 1;
        }
    }
}
