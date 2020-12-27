<?php


namespace App\Services\API\v1\Psychologist;

use App\Models\Psychologist;
use App\Repositories\PsychologistAvailabilityCalendarRepository;
use Exception;

class DestroyAllPsychologistAvailabilityCalendarService extends PsychologistAvailabilityCalendarRepository
{

    /**
     * execute
     *
     * @param Psychologist $psychologist
     * @return boolean
     * @throws Exception
     */
    public function execute(Psychologist $psychologist): bool
    {
        if(!$psychologist)
            throw new Exception("Erro ao excluir os horários!", 500);

        return parent::destroyAll($psychologist);
    }
}
