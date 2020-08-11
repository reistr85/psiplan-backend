<?php

use App\Models\Occupation;
use Illuminate\Database\Seeder;

class OccupationsTableSeeder extends Seeder
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
            ['description' => 'Psicólogo', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];
        Occupation::insert($data);
    }
}
