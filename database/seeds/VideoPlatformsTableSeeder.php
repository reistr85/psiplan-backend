<?php

use App\Models\VideoPlatform;
use Illuminate\Database\Seeder;

class VideoPlatformsTableSeeder extends Seeder
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
            ['description' => 'Whatsapp', 'image' => 'Whatsapp.jpg', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Skype', 'image' => 'Skype.jpg', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Hangouts', 'image' => 'Hangouts.jpg', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Zoom', 'image' => 'Zoom.jpg', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        VideoPlatform::insert($data);
    }
}
