<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeUsersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        $this->call(PsychologistsTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(PsychologistLanguagesTableSeeder::class);
        $this->call(OccupationsTableSeeder::class);
        $this->call(PsychologistOccupationsTableSeeder::class);
        $this->call(TargetAudiencesTableSeeder::class);
        $this->call(PsychologistTargetAudiencesTableSeeder::class);
        $this->call(ApproachesTableSeeder::class);
        $this->call(PsychologistApproachesTableSeeder::class);
        $this->call(SpecialtyTableSeeder::class);
        $this->call(PsychocologistSpecialtyTableSeeder::class);
        $this->call(PsychologistAcademicFormationsTableSeeder::class);
    }
}
