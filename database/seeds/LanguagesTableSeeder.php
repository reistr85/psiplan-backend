<?php

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
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
            ['description' => 'Português (Brasil)', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Português (Portugal)', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Inglês', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Espanhol', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Francês', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        Language::insert($data);
    }
}
