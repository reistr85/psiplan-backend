<?php

use App\Models\PsychologistOccupation;
use Illuminate\Database\Seeder;

class PsychologistOccupationsTableSeeder extends Seeder
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
            ['psychologist_id' => 1, 'occupation_id' => 1, 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp]
        ];
        PsychologistOccupation::insert($data);
    }
}
