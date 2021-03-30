<?php


namespace App\Services\API\v1\Dashboard;


use App\Repositories\PsychologistRepository;

class GetAllPsychologistsService
{
    private $psychologist_repository;

    public function __construct(
        PsychologistRepository $psychologist_repository)
    {
        $this->psychologist_repository = $psychologist_repository;
    }

    public function execute()
    {
        return $this->psychologist_repository->getAll()->with('city')->get();
    }
}
