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
                'name' => 'Psicólogo de Teste 1',
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
            ],
            [
                'user_id' => 2,
                'city_id' => 4111, //3240 - RECIFE
                'name' => 'Psicólogo de Teste 2',
                'email' => 'psiteste@gmail.com',
                'birth' => '1985-11-21',
                'cpf' => '39793947004',
                'phone' => '84988481941',
                'country' => 'Brasil',
                'consultation_value' => '55.00',
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
            ],
            [
                'user_id' => 2,
                'city_id' => 2596, //3240 - JOAO PESSOA
                'name' => 'Psicólogo de Teste 3',
                'email' => 'psiteste@gmail.com',
                'birth' => '1985-11-21',
                'cpf' => '39793947004',
                'phone' => '84988481941',
                'country' => 'Brasil',
                'consultation_value' => '125.00',
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
            ],
            [
                'user_id' => 2,
                'city_id' => 5210, //3240 - TERESINA
                'name' => 'Psicólogo de Teste 4',
                'email' => 'psiteste@gmail.com',
                'birth' => '1985-11-21',
                'cpf' => '39793947004',
                'phone' => '84988481941',
                'country' => 'Brasil',
                'consultation_value' => '75.00',
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
            ],
            [
                'user_id' => 2,
                'city_id' => 1928, //3240 - GOIANIA
                'name' => 'Psicólogo de Teste 5',
                'email' => 'psiteste@gmail.com',
                'birth' => '1985-11-21',
                'cpf' => '39793947004',
                'phone' => '84988481941',
                'country' => 'Brasil',
                'consultation_value' => '55.00',
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
            ],
            [
                'user_id' => 2,
                'city_id' => 4811, //3240 - SAO LUIS
                'name' => 'Psicólogo de Teste 6',
                'email' => 'psiteste@gmail.com',
                'birth' => '1985-11-21',
                'cpf' => '39793947004',
                'phone' => '84988481941',
                'country' => 'Brasil',
                'consultation_value' => '65.00',
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
