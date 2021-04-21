<?php


namespace App\Services\API\v1\Dashboard;


use App\Repositories\QueryRepository;

class GetAllQueriesService
{
    private $query_repository;

    public function __construct(
        QueryRepository $query_repository)
    {
        $this->query_repository = $query_repository;
    }

    public function execute()
    {
        return $this->query_repository->getAll()
            ->with('psychologist', 'psychologist.city', 'client',
                'psychologistAvailabilityCalendar', 'psychologistAvailabilityCalendar.typeService',
                'videoPlatform')->get();
    }
}
