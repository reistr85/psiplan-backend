<?php

use Illuminate\Database\Seeder;
use App\Models\PsychologistTargetAudience;

class PsychologistTargetAudiencesTableSeeder extends Seeder
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
            ['psychologist_id' => 1, 'target_audience_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'target_audience_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'target_audience_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 2, 'target_audience_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 2, 'target_audience_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 3, 'target_audience_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 3, 'target_audience_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 4, 'target_audience_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 4, 'target_audience_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 5, 'target_audience_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 5, 'target_audience_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 6, 'target_audience_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 6, 'target_audience_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        PsychologistTargetAudience::insert($data);
    }
}
