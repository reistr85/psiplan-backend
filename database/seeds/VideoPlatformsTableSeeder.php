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
            ['description' => 'Whatsapp', 'image' => 'WhatsApp.png', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Skype', 'image' => 'Skype.png', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Hangouts', 'image' => 'Hangouts.png', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Zoom', 'image' => 'Zoom.png', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        VideoPlatform::insert($data);
    }
}
