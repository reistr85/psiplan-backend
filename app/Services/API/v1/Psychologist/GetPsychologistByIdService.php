<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistRepository;

class GetPsychologistByIdService
{
    private $psychologist_repository;

    public function __construct(
        PsychologistRepository $psychologist_repository)
    {
        $this->psychologist_repository = $psychologist_repository;
    }

    public function execute(int $psychologist_id)
    {
        return $this->psychologist_repository->find($psychologist_id);
    }
}
