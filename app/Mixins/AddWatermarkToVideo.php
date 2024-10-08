<?php

namespace App\Mixins;

use ProtoneMedia\LaravelFFMpeg\Filters\WatermarkFactory;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class AddWatermarkToVideo
{
    public static function addWatermarkToVideo(string $filepath, string $target): void
    {
        FFMpeg::fromDisk('videos')->open($filepath)
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
