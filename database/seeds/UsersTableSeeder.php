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
        User::create([
            'type_user_id' => 1,
            'name' => 'Administrador',
            'email' => 'admin@psiplan.com.br',
            'cpf' => '02664093347',
            'password' => bcrypt('re851120'),
            'active' => 0,
        ]);
    }
}
