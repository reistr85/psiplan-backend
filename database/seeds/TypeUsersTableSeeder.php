<?php

use App\Models\TypeUser;
use Illuminate\Database\Seeder;

class TypeUsersTableSeeder extends Seeder
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
            ['description' => 'Administrador', 'slug' => 'admin', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Psicólogo', 'slug' => 'psi', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Cliente', 'slug' => 'cli', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Empresa', 'slug' => 'emp', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];
        TypeUser::insert($data);

    }
}
