<?php


namespace App\Services\API\v1\Psychologist;


use App\Models\Psychologist;
use App\Repositories\PsychologistRepository;

class GetPsychologistByUserIdService extends PsychologistRepository
{
    private $get_all_images_psychologist_service;

    public function __construct(
        Psychologist $model,
        GetAllImagesPsychologistService $get_all_images_psychologist_service)
    {
        parent::__construct($model);
        $this->get_all_images_psychologist_service = $get_all_images_psychologist_service;
    }

    public function execute()
    {
        $psychologist = auth()->user()->psychologist;
        $this->get_all_images_psychologist_service->execute($psychologist);

        return $psychologist;
    }
}
