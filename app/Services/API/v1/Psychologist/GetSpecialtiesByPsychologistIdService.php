<?php


namespace App\Services\API\v1\Psychologist;


use App\Models\Psychologist;
use App\Repositories\PsychologistRepository;

class GetSpecialtiesByPsychologistIdService extends PsychologistRepository
{

    /**
     * Get All Specialties by Psychologist Id.
     *
     * @param int $psychologist_id
     * @return array
     */
    public function execute($psychologist_id)
    {
        return parent::getSpecialities($psychologist_id)->get();
    }
}
