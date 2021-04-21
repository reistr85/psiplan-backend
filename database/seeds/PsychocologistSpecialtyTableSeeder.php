<?php

use App\Models\PsychologistSpecialty;
use Illuminate\Database\Seeder;

class PsychocologistSpecialtyTableSeeder extends Seeder
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
            ['psychologist_id' => 1, 'specialty_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'specialty_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'specialty_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'specialty_id' => 4, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'specialty_id' => 5, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];
        PsychologistSpecialty::insert($data);
    }
}
