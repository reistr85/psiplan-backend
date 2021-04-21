<?php
namespace App\Services\API\v1\Psychologist;

use App\Repositories\PsychologistRepository;
use App\Repositories\PsychologistPlanRepository;
use App\Models\Psychologist;
use App\Jobs\SendEmailCancelAccount;
use App\Mail\UpdatePlan;

class CancelAccountPsychologistService {

  private $psychologist_repository;
  private $psychologist_plan_repository;

  public function __construct(
    PsychologistRepository $psychologist_repository,
    PsychologistPlanRepository $psychologist_plan_repository)
  {
    $this->psychologist_repository = $psychologist_repository;
    $this->psychologist_plan_repository = $psychologist_plan_repository;
  }


  public function execute(Psychologist $psychologist)
  {
      if(!$psychologist)
        throw new \Exception("Psicólogo não localizado", 500);

      $psychologist_plans = $this->psychologist_plan_repository->allByPsychologistId($psychologist->id);
      $psychologist_plans->delete();
      $this->psychologist_repository->edit($psychologist, ['plan_id' => null]);

      $data = ['name' => $psychologist->name, 'email' => $psychologist->email];
      SendEmailCancelAccount::dispatch($data);

      return true;
  }
}
