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
        $this->call(CitiesTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        $this->call(PlansFeaturesTableSeeder::class);
        $this->call(PlansContentsTableSeeder::class);
        $this->call(PsychologistsTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(PsychologistLanguagesTableSeeder::class);
        $this->call(OccupationsTableSeeder::class);
        $this->call(PsychologistOccupationsTableSeeder::class);
        $this->call(TargetAudiencesTableSeeder::class);
        $this->call(PsychologistTargetAudiencesTableSeeder::class);
        $this->call(SpecialtyTableSeeder::class);
        $this->call(PsychocologistSpecialtyTableSeeder::class);
        $this->call(PsychologistAcademicFormationsTableSeeder::class);
        $this->call(VideoPlatformsTableSeeder::class);
        $this->call(PsychologistVideoPlatformsTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(PsychologistGenresTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(PsychologistNotificationsTableSeeder::class);
    }
}
