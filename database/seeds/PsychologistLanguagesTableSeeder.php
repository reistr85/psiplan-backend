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
            ['psychologist_id' => 1, 'language_id' => 1, 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'language_id' => 3, 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'language_id' => 4, 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];
        PsychologistLanguage::insert($data);
    }
}
