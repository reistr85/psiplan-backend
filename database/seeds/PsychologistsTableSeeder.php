<?php

use App\Models\Psychologist;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class PsychologistsTableSeeder extends Seeder
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
            [
                'user_id' => 2,
                'city_id' => 4111, //3240 - RECIFE
                'plan_id' => '1',
                'name' => 'Psicólogo de Teste',
                'email' => 'psiteste@gmail.com',
                'birth' => '1985-11-21',
                'cpf' => '39793947004',
                'phone' => '84988481941',
                'country' => 'Brasil',
                'consultation_value' => '55.00',
                'consultation_duration' => '50',
                'social_consultation_value' => '45.00',
                'first_free_consultation' => '0',
                'consultation_package' => '0',
                'voluntary_service' => '0',
                'profile_consultation_value' => '0',
                'libras' => '0',
                'accessibility' => '0',
                'description' => Lorem::text(250),
                'approach' => Lorem::text(17),
                'crp' => '00000000',
                'pis' => '0000000000',
                'complete_profile' => 'completed',
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        Psychologist::insert($data);
    }
}
