<?php


namespace App\Services\API\v1\Psychologist;


use App\Models\Psychologist;
use App\Repositories\PsychologistRepository;
use App\Services\API\v1\Psychologist\GetTotalStarByPsychologistIdService;

class GetPsychologistProfileDetailsService extends PsychologistRepository
{
    private $get_all_images_psychologist_service;
    private $get_total_star_by_psychologist_id_service;

    public function __construct(
        Psychologist $model,
        GetAllImagesPsychologistService $get_all_images_psychologist_service,
        GetTotalStarByPsychologistIdService $get_total_star_by_psychologist_id_service)
    {
        parent::__construct($model);
        $this->get_all_images_psychologist_service = $get_all_images_psychologist_service;
        $this->get_total_star_by_psychologist_id_service = $get_total_star_by_psychologist_id_service;
    }

    public function execute($id)
    {
        $user = auth()->user();
        $psychologist = parent::getPsychologist($id)
            ->with('specialties', 'academicFormations', 'targetAudiences', 'languages', 'serviceAddress', 'videoPlatforms')
            ->first();

        if (!$psychologist)
            throw new \Exception("Psicólogo não encontrado", 500);

        if(!$user) {
            if ($psychologist->complete_profile == 'incomplete')
                throw new \Exception("Psicólogo não encontrado", 500);
        }

        if ($psychologist->complete_profile == 'incomplete' && $user->psychologist->id != $psychologist->id)
            throw new \Exception("Psicólogo não encontrado", 500);

        $this->get_all_images_psychologist_service->execute($psychologist);
        $psychologist->star = $this->get_total_star_by_psychologist_id_service->execute($psychologist->id);

        return $psychologist;
    }
}
