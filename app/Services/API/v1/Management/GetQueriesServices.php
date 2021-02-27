<?php


namespace App\Services\API\v1\Management;


use App\Repositories\QueryRepository;

class GetQueriesServices
{
    private $query_repository;

    public function __construct(
        QueryRepository $query_repository)
    {
        $this->query_repository = $query_repository;
    }

    public function execute(int $psychologist_id)
    {
        return $this->query_repository->getAllQueriesFindByPsychologistId($psychologist_id)->get();
    }
}
