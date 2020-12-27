<?php


namespace App\Services\API\v1\Psychologist;

use App\Repositories\PsychologistAvailabilityCalendarRepository;
use Exception;

class DestroyPsychologistAvailabilityCalendarService extends PsychologistAvailabilityCalendarRepository
{
    public function execute(int $psychologist_id, int $id): bool
    {
        $psychologist_availability_calendar = parent::find($id);

        if(!$psychologist_availability_calendar)
            throw new Exception("O Registro não foi localizado!", 500);

        if($psychologist_availability_calendar->psychologist_id != $psychologist_id)
            throw new Exception("Este registro não pode ser excluído!", 500);

        return parent::destroy($psychologist_availability_calendar);
    }
}
