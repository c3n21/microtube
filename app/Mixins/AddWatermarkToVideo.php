<?php

namespace App\Mixins;

use ProtoneMedia\LaravelFFMpeg\Filters\WatermarkFactory;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class AddWatermarkToVideo
{
    /**
     * Add a watermark to a video.
     *
     * The input file will be read from `tmp(disk)/$filename` and will be exported in the `videos` disk.
     *
     * @param string $filename name of the under `tmp` disk
     */
    public static function addWatermarkToVideo(string $filename, string $target): void
    {
        FFMpeg::fromDisk('tmp')->open($filename)
            ->addWatermark(function (WatermarkFactory $watermarkFactory) {
                return $watermarkFactory->fromDisk('public')
                    ->open('microtube.png')
                    ->resize(50, 50)
                    ->right(25)
                    ->bottom(25);
            })
            ->export()
            ->toDisk('videos')
            ->inFormat(new \FFMpeg\Format\Video\X264())
            ->save($target);
    }
}
