<?php

use App\Models\TypeService;
use Illuminate\Database\Seeder;

class TypeServicesTableSeeder extends Seeder
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
            ['description' => 'Online', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Presencial', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];
        TypeService::insert($data);
    }
}
