<?php

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
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
            ['description' => 'Caixa Econômica','active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Banco do Brasil','active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Santander','active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Bradesco','active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Itaú','active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'NuBank','active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Banco Inter','active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        Bank::insert($data);
    }
}
