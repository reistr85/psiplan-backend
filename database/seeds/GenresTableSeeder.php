<?php

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
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
            ['description' => 'Homem', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Mulher', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Outro', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];
        Genre::insert($data);
    }
}
