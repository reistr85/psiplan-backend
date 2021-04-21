<?php


namespace App\Services\API\v1\Dashboard;

use App\Repositories\PsychologistRepository;
use App\Models\Psychologist;

class UpdatePsychologistService
{

  private $psychologist_repository;

  public function __construct(
    PsychologistRepository $psychologist_repository)
  {
      $this->psychologist_repository = $psychologist_repository;
  }

  public function execute($id, $data)
  {
      $psychologist = $this->psychologist_repository->find($id);
      return $this->psychologist_repository->edit($psychologist, $data);
  }
}
