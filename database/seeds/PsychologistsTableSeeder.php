<?php

use App\Psychologist;
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
                'name' => 'Psicólogo de Teste',
                'email' => 'psiteste@gmail.com',
                'birth' => '1985-11-20',
                'cpf' => '39793947004',
                'phone' => '84988481941',
                'country' => 'Brasil',
                'query_value' => '85.00',
                'query_value_social' => '45.00',
                'query_duration' => '50',
                'description' => Lorem::text(250),
                'crp' => '00000000',
                'pis' => '0000000000',
                'bank_id' => '1',
                'agency' => '2044',
                'type_account' => 'Poupança',
                'number_account' => '71447-7',
                'cpf_holder_account' => '39793947004',
                'cnpj_holder_account' => null,
                'active' => 0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]
        ];

        Psychologist::insert($data);
    }
}
