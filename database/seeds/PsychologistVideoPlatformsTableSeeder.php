<?php

use App\Models\PsychologistVideoPlatform;
use Illuminate\Database\Seeder;

class PsychologistVideoPlatformsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = date('Y-m-d H:i:s');

        $data = [
            ['psychologist_id' => 1, 'video_platform_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'video_platform_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'video_platform_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'video_platform_id' => 4, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        PsychologistVideoPlatform::insert($data);
    }
}
