<?php


namespace App\Services\API\v1;


use App\Models\Psychologist;
use App\Repositories\PsychologistRepository;

class ListPsychologistService
{

    private $psychologist;
    private $psychologistRepository;

    public function __construct(Psychologist $psychologist, PsychologistRepository $psychologistRepository)
    {
        $this->psychologist = $psychologist;
        $this->psychologistRepository = $psychologistRepository;
    }

    public function index($params)
    {
        $psychologists = $this->psychologist = $this->psychologistRepository->index($params);
        return $psychologists;
    }
}
