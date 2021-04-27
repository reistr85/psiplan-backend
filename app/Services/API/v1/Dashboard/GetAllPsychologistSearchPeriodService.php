<?php


namespace App\Services\API\v1\Dashboard;


use App\Repositories\PsychologistRepository;

class GetAllPsychologistSearchPeriodService
{
    private $psychologist_repository;

    public function __construct(
        PsychologistRepository $psychologist_repository)
    {
        $this->psychologist_repository = $psychologist_repository;
    }

    public function execute(string $data_initial, string $data_final)
    {
        return $this->psychologist_repository->getAllSearchPeriod($data_initial, $data_final)->with('city')->get();
    }
}
