<?php

use App\Models\PsychologistLanguage;
use Illuminate\Database\Seeder;

class PsychologistLanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = date('Y-m-d H:i:s');

        $data=  [
            ['psychologist_id' => 1, 'language_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'language_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'language_id' => 4, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 2, 'language_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 2, 'language_id' => 4, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 3, 'language_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 3, 'language_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 4, 'language_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 4, 'language_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 5, 'language_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 5, 'language_id' => 4, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 6, 'language_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 6, 'language_id' => 4, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];
        PsychologistLanguage::insert($data);
    }
}
