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
            ['psychologist_id' => 1, 'specialty_id' => 1, 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'specialty_id' => 2, 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'specialty_id' => 3, 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'specialty_id' => 4, 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'specialty_id' => 5, 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];
        PsychologistSpecialty::insert($data);
    }
}
