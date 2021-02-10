<?php


namespace App\Services\API\v1\Psychologist;

use App\Repositories\PlanRepository;
use App\Repositories\PsychologistPlanRepository;

class CreatePsychologistPlanService
{

    private $psychologist_plan_repository;
    private $plan_repository;

    public function __construct(
        PsychologistPlanRepository $psychologist_plan_repository,
        PlanRepository $plan_repository)
    {
        $this->psychologist_plan_repository = $psychologist_plan_repository;
        $this->plan_repository = $plan_repository;
    }

    public function execute(string $plan_name)
    {
        $psychologist = auth()->user()->psychologist;
        $plan = $this->plan_repository->getByName($plan_name)->first();
        $psychologist_plans = $this->psychologist_plan_repository->allByPsychologistId($psychologist->id);

       $psychologist_plans->delete();

        return $this->psychologist_plan_repository->store([
            'psychologist_id' => $psychologist->id,
            'plan_id' => $plan->id,
        ]);
    }
}
