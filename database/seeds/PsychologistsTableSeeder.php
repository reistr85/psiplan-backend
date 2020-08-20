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
                'city_id' => 3240, //3240 - NATAL
                'name' => 'Psicólogo de Teste',
                'email' => 'psiteste@gmail.com',
                'birth' => '1985-11-21',
                'cpf' => '39793947004',
                'phone' => '84988481941',
                'country' => 'Brasil',
                'consultation_value' => '85.00',
                'consultation_duration' => '50',
                'social_consultation_value' => '45.00',
                'first_free_consultation' => '1',
                'description' => Lorem::text(250),
                'avatar' => 'avatar.jpg',
                'crp' => '00000000',
                'pis' => '0000000000',
                'bank_id' => '1',
                'agency' => '2044',
                'type_account' => 'Poupança',
                'number_account' => '71447-7',
                'cpf_holder_account' => '39793947004',
                'cnpj_holder_account' => null,
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]
        ];

        Psychologist::insert($data);
    }
}
