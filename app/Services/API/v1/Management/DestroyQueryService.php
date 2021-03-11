<?php


namespace App\Services\API\v1\Management;


use App\Repositories\QueryRepository;

class DestroyQueryService
{
    private $query_repository;

    public function __construct(
        QueryRepository $query_repository)
    {
        $this->query_repository = $query_repository;
    }

    public function execute(int $id)
    {
        $query = $this->query_repository->find($id);

        if(!$query)
            throw new \Exception("Consulta não localizada.", 500);

        return $this->query_repository->destroy($query);
    }
}
