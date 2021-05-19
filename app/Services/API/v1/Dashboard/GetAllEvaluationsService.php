<?php


namespace App\Services\API\v1\Dashboard;

use App\Repositories\EvaluationRepository;

class GetAllEvaluationsService
{
    private $evaluation_repository;

    public function __construct(
        EvaluationRepository $evaluation_repository)
    {
        $this->evaluation_repository = $evaluation_repository;
    }

    public function execute()
    {
        return $this->evaluation_repository->getAll()
            ->with('querie', 'querie.client', 'querie.psychologist')->get();
    }
}
