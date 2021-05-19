<?php


namespace App\Services\API\v1\Dashboard;


use App\Repositories\EvaluationRepository;

class GetEvaluationService
{
    private $evaluation_repository;

    public function __construct(
        EvaluationRepository $evaluation_repository)
    {
        $this->evaluation_repository = $evaluation_repository;
    }

    public function execute(int $id)
    {
        return $this->evaluation_repository->find($id);
    }
}
