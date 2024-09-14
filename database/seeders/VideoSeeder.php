<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

/**
 * This assumes you have 3 users with user_id 1,2,3
 */
class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::factory(10)->create([
            'user_id' => 2,
            'title' => "Test Video",
        ]);

        Video::factory(10)->create([
            'user_id' => 3,
            'title' => "Test Video",
        ]);

        Video::factory(10)->create([
            'user_id' => 1,
            'title' => "Test Video",
        ]);
    }
}
