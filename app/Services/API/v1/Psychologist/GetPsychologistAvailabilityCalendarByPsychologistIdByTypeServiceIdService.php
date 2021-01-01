<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistAvailabilityCalendarRepository;

class GetPsychologistAvailabilityCalendarByPsychologistIdByTypeServiceIdService extends PsychologistAvailabilityCalendarRepository
{
    public function execute(int $psychologist_id, int $type_service_id)
    {
        return parent::getPsychologistAvailabilityCalendarByPsychologistIdByTypeServiceId($psychologist_id, $type_service_id)->get();
    }
}
