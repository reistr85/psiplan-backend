<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistAvailabilityCalendarRepository;

class GetPsychologistAvailabilityCalendarByPsychologistIdService extends PsychologistAvailabilityCalendarRepository
{
    public function execute(int $psychologist_id)
    {
        return parent::getPsychologistAvailabilityCalendarByPsychologistId($psychologist_id)->get();
    }
}
