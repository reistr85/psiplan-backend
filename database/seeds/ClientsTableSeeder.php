<?php

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
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
            ['user_id' => 3, 'name' => 'Cliente de Teste', 'email' => 'cliteste@gmail.com', 'phone' => '84988481919','is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];
        Client::insert($data);
    }
}
