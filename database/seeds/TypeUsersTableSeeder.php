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
        TypeUser::create([
            'description' => 'Administrador',
            'slug' => 'admin',
            'active' => 0,
        ]);

        TypeUser::create([
            'description' => 'Psicólogo',
            'slug' => 'psi',
            'active' => 0,
        ]);

        TypeUser::create([
            'description' => 'Cliente',
            'slug' => 'cli',
            'active' => 0,
        ]);

        TypeUser::create([
            'description' => 'Empresa',
            'slug' => 'emp',
            'active' => 0,
        ]);
    }
}
