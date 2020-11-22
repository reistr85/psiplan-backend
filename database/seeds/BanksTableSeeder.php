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
            ['description' => 'Default','is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Caixa Econômica','is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Banco do Brasil','is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Santander','is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Bradesco','is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Itaú','is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'NuBank','is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Banco Inter','is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        Bank::insert($data);
    }
}
