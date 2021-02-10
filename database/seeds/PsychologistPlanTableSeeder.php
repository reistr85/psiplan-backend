<?php

use Illuminate\Database\Seeder;

class PsychologistPlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = date('Y-m-d H:i:s');

        $data=  [
            ['psychologist_id' => '1', 'plan_id' => '1', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => '2', 'plan_id' => '2', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => '3', 'plan_id' => '3', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => '4', 'plan_id' => '1', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => '5', 'plan_id' => '2', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => '6', 'plan_id' => '4', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        \App\Models\PsychologistPlan::insert($data);
    }
}
