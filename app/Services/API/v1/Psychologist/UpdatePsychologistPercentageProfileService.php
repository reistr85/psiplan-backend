<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistRepository;

class UpdatePsychologistPercentageProfileService
{
    private $psychologist_repository;

    public function __construct(PsychologistRepository $psychologist_repository)
    {
        $this->psychologist_repository = $psychologist_repository;
    }

    public function execute(int $psychologist_id, int $value, string $action)
    {
        $psychologist = $this->psychologist_repository->find($psychologist_id);
        $percentage = $psychologist->percentage_profile;

        if(!$psychologist)
            throw new \Exception("O Psicólogo não foi localizado", 500);

        if($action == 'add' && $psychologist->percentage_profile < 100){
            $percentage = $psychologist->percentage_profile + $value;
        }elseif($action == 'rem' && $psychologist->percentage_profile >= 10){
            $percentage = $psychologist->percentage_profile - $value;
        }

        if($percentage)
            $this->psychologist_repository->update($psychologist, ['percentage_profile' => $percentage]);

        return $percentage;
    }
}
