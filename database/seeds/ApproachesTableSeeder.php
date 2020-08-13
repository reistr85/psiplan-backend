<?php

use App\Models\Approach;
use Illuminate\Database\Seeder;

class ApproachesTableSeeder extends Seeder
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
            ['description' => 'Terapia cognitivo comportamental', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Fenomenologia', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Gestalt-terapia', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Humanística', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Junguiana', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Psicologia análitica', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Psicanálise', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Transpessoal', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Neuropsicolgia', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Sócio-histórica', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Psicomotora', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Outros', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        Approach::insert($data);
    }
}
