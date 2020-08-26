<?php

use App\Models\PsychologistOccupation;
use Illuminate\Database\Seeder;

class PsychologistOccupationsTableSeeder extends Seeder
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
            ['psychologist_id' => 1, 'occupation_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 2, 'occupation_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 3, 'occupation_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 4, 'occupation_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 5, 'occupation_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 6, 'occupation_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];
        PsychologistOccupation::insert($data);
    }
}
