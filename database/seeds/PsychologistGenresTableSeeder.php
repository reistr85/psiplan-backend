<?php

use App\Models\PsychologistGenre;
use Illuminate\Database\Seeder;

class PsychologistGenresTableSeeder extends Seeder
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
            ['psychologist_id' => 1, 'genre_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'genre_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'genre_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 2, 'genre_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 2, 'genre_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 3, 'genre_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 3, 'genre_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        PsychologistGenre::insert($data);
    }
}
