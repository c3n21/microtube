<?php

namespace App\Mixins;

use FFMpeg\Format\Video\X264;
use ProtoneMedia\LaravelFFMpeg\Exporters\HLSVideoFilters;
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
        $lowBitrate = (new X264())->setKiloBitrate(250);
        $midBitrate = (new X264())->setKiloBitrate(500);
        $highBitrate = (new X264())->setKiloBitrate(1000);

        FFMpeg::fromDisk('tmp')->open($filename)
            ->exportForHLS()
            ->addFormat($lowBitrate, static::addWatermark(...))
            ->addFormat($midBitrate, static::addWatermark(...))
            ->addFormat($highBitrate, static::addWatermark(...))
            ->toDisk('videos')
            ->save($target);
    }

    private static function addWatermark(HLSVideoFilters $filters)
    {
        $filters->addWatermark(function (WatermarkFactory $watermarkFactory) {
            return $watermarkFactory->fromDisk('public')
                ->open('microtube.png')
                ->resize(50, 50)
                ->right(25)
                ->bottom(25);
        });
    }
}
