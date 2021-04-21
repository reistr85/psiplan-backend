<?php


namespace App\Services\API\v1\Evaluation;


use App\Enums\NotificationsStatusEnum;
use App\Repositories\EvaluationRepository;

class GetAllEvaluationByPsychologistIdService
{
    private $evaluation_repository;

    public function __construct(
        EvaluationRepository $evaluation_repository)
    {
        $this->evaluation_repository = $evaluation_repository;
    }

    public function execute(int $psychologist_id)
    {
        return $this->evaluation_repository->getAllByPsychologistId($psychologist_id)->get();
    }
}
