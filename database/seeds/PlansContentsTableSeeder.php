<?php

use App\Models\PlanContent;
use Illuminate\Database\Seeder;

class PlansContentsTableSeeder extends Seeder
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
            ['plan_id' => 1, 'plan_feature_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 1, 'plan_feature_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 1, 'plan_feature_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 1, 'plan_feature_id' => 4, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 1, 'plan_feature_id' => 5, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 1, 'plan_feature_id' => 6, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 1, 'plan_feature_id' => 7, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 2, 'plan_feature_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 2, 'plan_feature_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 2, 'plan_feature_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 2, 'plan_feature_id' => 4, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 2, 'plan_feature_id' => 6, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 2, 'plan_feature_id' => 7, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 2, 'plan_feature_id' => 8, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 2, 'plan_feature_id' => 9, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 2, 'plan_feature_id' => 11, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 2, 'plan_feature_id' => 11, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 2, 'plan_feature_id' => 11, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 2, 'plan_feature_id' => 13, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 2, 'plan_feature_id' => 14, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 2, 'plan_feature_id' => 16, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 4, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 5, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 6, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 7, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 8, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 9, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 10, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 11, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 12, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 13, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 14, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 15, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 16, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 17, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 18, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['plan_id' => 3, 'plan_feature_id' => 19, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        PlanContent::insert($data);
    }
}
