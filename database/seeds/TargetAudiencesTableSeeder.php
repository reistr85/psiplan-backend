<?php

use App\Models\TargetAudience;
use Illuminate\Database\Seeder;

class TargetAudiencesTableSeeder extends Seeder
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
            ['description' => 'Criança', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Adolescente', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Adulto', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        TargetAudience::insert($data);
    }
}
