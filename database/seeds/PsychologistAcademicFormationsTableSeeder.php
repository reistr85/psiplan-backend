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
                'description' => Lorem::text(20),
                'institution' => Lorem::text(10),
                'period' => '2015-2020',
                'details' => Lorem::text(35),
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'psychologist_id' => 2,
                'description' => Lorem::text(20),
                'institution' => Lorem::text(10),
                'period' => '2015-2020',
                'details' => Lorem::text(35),
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'psychologist_id' => 3,
                'description' => Lorem::text(20),
                'institution' => Lorem::text(10),
                'period' => '2015-2020',
                'details' => Lorem::text(35),
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'psychologist_id' => 4,
                'description' => Lorem::text(20),
                'institution' => Lorem::text(10),
                'period' => '2015-2020',
                'details' => Lorem::text(35),
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'psychologist_id' => 5,
                'description' => Lorem::text(20),
                'institution' => Lorem::text(10),
                'period' => '2015-2020',
                'details' => Lorem::text(35),
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'psychologist_id' => 6,
                'description' => Lorem::text(20),
                'institution' => Lorem::text(10),
                'period' => '2015-2020',
                'details' => Lorem::text(35),
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];
        PsychologistAcademicFormation::insert($data);
    }
}
