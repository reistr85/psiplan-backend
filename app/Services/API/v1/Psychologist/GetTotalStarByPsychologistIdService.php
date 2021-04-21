<?php


namespace App\Services\API\v1\Psychologist;

use App\Repositories\PsychologistRepository;
use App\Repositories\QueryRepository;

class GetTotalStarByPsychologistIdService
{
    private $query_repository;
    private $psychologist_repository;

    public function __construct(
        QueryRepository $query_repository,
        PsychologistRepository $psychologist_repository)
    {
        $this->query_repository = $query_repository;
        $this->psychologist_repository = $psychologist_repository;
    }

    public function execute(int $psychologist_id)
    {
        $psychologist = $this->psychologist_repository->find($psychologist_id);

        return $psychologist->stars();
    }
}
