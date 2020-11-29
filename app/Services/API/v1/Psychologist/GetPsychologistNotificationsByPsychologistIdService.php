<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistRepository;
use Illuminate\Support\Collection;

class GetPsychologistNotificationsByPsychologistIdService extends PsychologistRepository
{

    /**
     * Get All Specialties by Psychologist Id.
     *
     * @param int $psychologist_id
     * @return Collection
     */
    public function execute(int $psychologist_id): Collection
    {
        return parent::getNotifications($psychologist_id)->get();
    }
}
