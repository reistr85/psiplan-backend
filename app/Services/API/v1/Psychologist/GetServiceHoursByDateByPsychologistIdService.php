<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistAvailabilityCalendarRepository;
use Illuminate\Database\Eloquent\Collection;

class GetServiceHoursByDateByPsychologistIdService extends PsychologistAvailabilityCalendarRepository
{
    public function execute(int $psychologist_id, array $data)
    {
        return parent::getPsychologistAvailabilityCalendarByDateByPsychologistId($psychologist_id, $data)->get();
    }
}
