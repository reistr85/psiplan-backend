<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistPreferenceRepository;

class CreatePsychologistPreferencesService
{
    private $psychologist_preference_repository;

    public function __construct(PsychologistPreferenceRepository $psychologist_preference_repository)
    {
        $this->psychologist_preference_repository = $psychologist_preference_repository;
    }

    public function execute(int $psychologist_id)
    {
        for ($i=1; $i<=8; $i++){
            $data = [
                'psychologist_id' => $psychologist_id,
                'notification_id' => $i,
                'is_active' => 0,
            ];

            $this->psychologist_preference_repository->store($data);
        }
    }

}
