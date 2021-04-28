<?php


namespace App\Services\API\v1\Dashboard;


use App\Repositories\PsychologistRepository;
use App\Repositories\QueryRepository;

class GetAllSearchPeriodService
{
    private $psychologist_repository;
    private $query_repository;

    public function __construct(
        PsychologistRepository $psychologist_repository,
        QueryRepository $query_repository)
    {
        $this->psychologist_repository = $psychologist_repository;
        $this->query_repository = $query_repository;
    }

    public function execute(string $type, string $data_initial, string $data_final)
    {
        if($type === 'psychologists'){
            return $this->psychologist_repository->getAllSearchPeriod($data_initial, $data_final)->with('city')->get();
        }else if($type === 'queries'){
            return $this->query_repository->getAllSearchPeriod($data_initial, $data_final)->with('psychologist', 'psychologist.city', 'client',
                'psychologistAvailabilityCalendar', 'psychologistAvailabilityCalendar.typeService',
                'videoPlatform')->get();
        }
    }
}
