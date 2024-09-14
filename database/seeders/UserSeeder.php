<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'created_at' => now(),
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => Hash::make('test'),
        ]);

        DB::table('users')->insert([
            'created_at' => now(),
            'name' => 'test2',
            'email' => 'test2@test.test',
            'password' => Hash::make('test'),
        ]);

        DB::table('users')->insert([
            'created_at' => now(),
            'name' => 'test3',
            'email' => 'test3@test.test',
            'password' => Hash::make('test'),
        ]);
    }
}
