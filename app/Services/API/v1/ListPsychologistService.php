<?php


namespace App\Services\API\v1;


use App\Models\Psychologist;
use App\Repositories\CityRepository;
use App\Repositories\GenreRepository;
use App\Repositories\PsychologistRepository;
use App\Repositories\TargetAudienceRepository;

class ListPsychologistService
{

    private $psychologist;
    private $psychologistRepository;
    private $cityRepository;
    private $targetAudienceRepository;
    private $genreRepository;

    public function __construct(Psychologist $psychologist, PsychologistRepository $psychologistRepository,
        CityRepository $cityRepository, TargetAudienceRepository $targetAudienceRepository, GenreRepository $genreRepository)
    {
        $this->psychologist = $psychologist;
        $this->psychologistRepository = $psychologistRepository;
        $this->cityRepository = $cityRepository;
        $this->targetAudienceRepository = $targetAudienceRepository;
        $this->genreRepository = $genreRepository;
    }

    public function index($params)
    {
        try{
            $query = $this->psychologistRepository->index($params);
            return $query->paginate(10);
        }catch (\Exception $e){

        }

    }

    public function getFilters()
    {
        try{
            $cities = $this->cityRepository->all();
            $targetAudiences = $this->targetAudienceRepository->all();
            $genres = $this->genreRepository->all();

            return [
                'cities' => $cities,
                'target_audiences' => $targetAudiences,
                'genres' => $genres,
            ];
        }catch (\Exception $e){

        }
    }
}
