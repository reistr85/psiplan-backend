<?php
namespace App\Services\API\v1\Psychologist;

use App\Repositories\PsychologistRepository;
use App\Models\Psychologist;

class CancelAccountPsychologistService {

  private $psychologist_repository;

  public function __construct(
    PsychologistRepository $psychologist_repository)
  {
    $this->psychologist_repository = $psychologist_repository;
  }


  public function execute(Psychologist $psychologist)
  {
      if(!$psychologist)
      throw new \Exception("Psicólogo não localizado", 500);

      $this->psychologist_repository->edit($psychologist, ['plan_id' => null]);

      return true;
  }
}
