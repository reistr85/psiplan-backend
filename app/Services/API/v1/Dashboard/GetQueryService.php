<?php


namespace App\Services\API\v1\Dashboard;


use App\Repositories\QueryRepository;

class GetQueryService
{
    private $query_repository;

    public function __construct(
        QueryRepository $query_repository)
    {
        $this->query_repository = $query_repository;
    }

    public function execute(int $id)
    {
        return $this->query_repository->find($id);
    }
}
