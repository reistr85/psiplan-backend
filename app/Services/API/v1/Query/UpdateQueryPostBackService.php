<?php


namespace App\Services\API\v1\Query;


use App\Repositories\QueryRepository;

class UpdateQueryPostBackService
{
    private $query_repository;

    public function __construct(
        QueryRepository $query_repository)
    {
        $this->query_repository = $query_repository;
    }

    public function execute(int $query_id, array $data)
    {
        $query = $this->query_repository->find($query_id);

        if(!$query)
            throw new \Exception("Consulta não encontrada", 500);

        return $this->query_repository->edit($query, $data);
    }
}
