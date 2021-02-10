<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistRepository;

class DefinePlanPsychologistService
{

    private $psychologist_repository;

    public function __construct(
        PsychologistRepository $psychologist_repository)
    {
        $this->psychologist_repository = $psychologist_repository;
    }

    public function execute(int $plan_id)
    {
        $psychologist = auth()->user()->psychologist;

        if(!$psychologist)
            throw new \Exception("Psicólogo não foi localizado", 500);

        return $this->psychologist_repository->edit($psychologist, ['plan_id' => $plan_id]);
    }
}
