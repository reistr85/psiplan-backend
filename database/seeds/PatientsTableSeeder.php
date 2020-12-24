<?php

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
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
            ['name' => 'Paciente de Teste 1', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Paciente de Teste 2', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];
        Patient::insert($data);
    }
}
