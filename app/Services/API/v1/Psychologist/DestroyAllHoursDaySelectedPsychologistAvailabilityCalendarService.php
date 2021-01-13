<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistAvailabilityCalendarRepository;

class DestroyAllHoursDaySelectedPsychologistAvailabilityCalendarService extends PsychologistAvailabilityCalendarRepository
{
    public function execute(int $psychologist_id, string $day_selected)
    {
        $hours = parent::getAllHoursDaySelectedByPsychologistId($psychologist_id, $day_selected)
            ->whereNull('available')->get();

        foreach ($hours as $item){
            $item->delete();
        }
    }
}
