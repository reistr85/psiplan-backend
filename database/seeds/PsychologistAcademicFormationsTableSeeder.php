<?php

use App\Models\PsychologistAcademicFormation;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class PsychologistAcademicFormationsTableSeeder extends Seeder
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
            [
                'psychologist_id' => 1,
                'type' => 'Doutorado',
                'description' => Lorem::text(20),
                'institution' => Lorem::text(10),
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'psychologist_id' => 1,
                'type' => 'Mestrado',
                'description' => Lorem::text(20),
                'institution' => Lorem::text(10),
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'psychologist_id' => 3,
                'type' => 'Especialização',
                'description' => Lorem::text(20),
                'institution' => Lorem::text(10),
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'psychologist_id' => 4,
                'type' => 'Pós-graduação',
                'description' => Lorem::text(20),
                'institution' => Lorem::text(10),
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'psychologist_id' => 5,
                'type' => 'Doutorado',
                'description' => Lorem::text(20),
                'institution' => Lorem::text(10),
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'psychologist_id' => 6,
                'type' => 'Mestrado',
                'description' => Lorem::text(20),
                'institution' => Lorem::text(10),
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];
        PsychologistAcademicFormation::insert($data);
    }
}
