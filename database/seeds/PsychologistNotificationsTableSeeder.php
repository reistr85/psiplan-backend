<?php

use App\Models\PsychologistNotification;
use Illuminate\Database\Seeder;

class PsychologistNotificationsTableSeeder extends Seeder
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
            ['psychologist_id' => 1, 'notification_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'notification_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'notification_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'notification_id' => 4, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'notification_id' => 5, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'notification_id' => 6, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'notification_id' => 7, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'notification_id' => 8, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 2, 'notification_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 2, 'notification_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 2, 'notification_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 2, 'notification_id' => 4, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 2, 'notification_id' => 5, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 2, 'notification_id' => 6, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 2, 'notification_id' => 7, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 2, 'notification_id' => 8, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 1, 'notification_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 3, 'notification_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 3, 'notification_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 3, 'notification_id' => 4, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 3, 'notification_id' => 5, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 3, 'notification_id' => 6, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 3, 'notification_id' => 7, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 3, 'notification_id' => 8, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 4, 'notification_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 4, 'notification_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 4, 'notification_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 4, 'notification_id' => 4, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 4, 'notification_id' => 5, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 4, 'notification_id' => 6, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 4, 'notification_id' => 7, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 4, 'notification_id' => 8, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 5, 'notification_id' => 1, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 5, 'notification_id' => 2, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 5, 'notification_id' => 3, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 5, 'notification_id' => 4, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 5, 'notification_id' => 5, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 5, 'notification_id' => 6, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 5, 'notification_id' => 7, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['psychologist_id' => 5, 'notification_id' => 8, 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];
        PsychologistNotification::insert($data);
    }
}
