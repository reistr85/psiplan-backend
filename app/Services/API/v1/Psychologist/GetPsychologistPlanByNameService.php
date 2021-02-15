<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PlanRepository;

class GetPsychologistPlanByNameService
{
    private $plan_repository;

    public function __construct(
        PlanRepository $plan_repository)
    {
        $this->plan_repository = $plan_repository;
    }

    public function execute(string $plan_name)
    {
        return $this->plan_repository->getByName($plan_name)->first();
    }
}
