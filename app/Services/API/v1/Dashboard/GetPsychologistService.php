<?php


namespace App\Services\API\v1\Dashboard;


use App\Repositories\PsychologistRepository;

class GetPsychologistService
{
    private $psychologist_repository;

    public function __construct(
        PsychologistRepository $psychologist_repository)
    {
        $this->psychologist_repository = $psychologist_repository;
    }

    public function execute(int $id)
    {
        return $this->psychologist_repository->getPsychologist($id)->with('specialties', 'academicFormations')->first();
    }
}
