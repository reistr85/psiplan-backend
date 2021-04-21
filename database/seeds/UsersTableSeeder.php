<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'type_user_id' => 1,
                'name' => 'Administrador',
                'email' => 'admin@psiplan.com.br',
                'cpf' => '02664093347',
                'password' => bcrypt('12345678'),
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'type_user_id' => 2,
                'name' => 'Psicólogo de Teste',
                'email' => 'psiteste@gmail.com',
                'cpf' => '39793947004',
                'password' => bcrypt('re851120'),
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'type_user_id' => 3,
                'name' => 'Cliente de Teste',
                'email' => 'cliteste@gmail.com',
                'cpf' => '39793947004',
                'password' => bcrypt('12345678'),
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]
        ];

        User::insert($data);
    }
}
