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
                'user_id' => 1,
                'city_id' => 3240, //3240 - NATAL
                'name' => 'Administrador',
                'plan_id' => '3',
                'email' => 'admin@psiplan.com.br',
                'birth' => '1985-11-21',
                'cpf' => '39793947004',
                'phone' => '84988481941',
                'country' => 'Brasil',
                'consultation_value' => '85.00',
                'consultation_duration' => '50',
                'social_consultation_value' => '45.00',
                'first_free_consultation' => '1',
                'consultation_package' => '15',
                'voluntary_service' => '1',
                'profile_consultation_value' => '1',
                'libras' => '1',
                'accessibility' => '1',
                'description' => Lorem::text(250),
                'approach' => Lorem::text(17),
                'crp' => '00000000',
                'pis' => '0000000000',
                'bank' => 'BANCO DO BRASIL',
                'agency' => '2044',
                'type_account' => 'CONTA POUPANÇA',
                'number_account' => '71447-7',
                'cpf_holder_account' => '39793947004',
                'complete_profile' => 'completed',
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'user_id' => 2,
                'city_id' => 4111, //3240 - RECIFE
                'plan_id' => '1',
                'name' => 'Psicólogo de Teste 2',
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
                'bank' => 'CAIXA ECONÔMICA',
                'agency' => '2044',
                'type_account' => 'CONTA POUPANÇA',
                'number_account' => '71447-7',
                'cpf_holder_account' => '39793947004',
                'complete_profile' => 'completed',
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'user_id' => 3,
                'city_id' => 2596, //3240 - JOAO PESSOA
                'plan_id' => '2',
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
                'consultation_package' => '0',
                'voluntary_service' => '0',
                'profile_consultation_value' => '1',
                'libras' => '0',
                'accessibility' => '1',
                'description' => Lorem::text(250),
                'approach' => Lorem::text(17),
                'crp' => '00000000',
                'pis' => '0000000000',
                'bank' => 'SANTANDER',
                'agency' => '2044',
                'type_account' => 'CONTA POUPANÇA',
                'number_account' => '71447-7',
                'cpf_holder_account' => '39793947004',
                'complete_profile' => 'completed',
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        Psychologist::insert($data);
    }
}
