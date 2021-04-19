<?php


namespace App\Services\API\v1\Psychologist;

use App\Repositories\QueryRepository;

class GetTotalStarByPsychologistIdService
{
    private $query_repository;

    public function __construct(
        QueryRepository $query_repository)
    {
        $this->query_repository = $query_repository;
    }

    public function execute(int $psychologist_id)
    {
        $queries = $this->query_repository->getAllQueriesFindByPsychologistId($psychologist_id)->with('star')->get();
        $stars = 0;

        foreach ($queries as $query){
            if($query->star)
                $stars += $query->star->star;
        }

        $qtd_queries = $queries->count();
        $number_of_possible_stars = $qtd_queries * 5;

        if(!$number_of_possible_stars)
            return 5;

        $percentage_star = $stars / $number_of_possible_stars;
        $qtd_stars = ceil(($percentage_star * 5));

        return $qtd_stars;
    }
}
