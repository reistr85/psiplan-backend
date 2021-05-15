<?php


namespace App\Services\API\v1\Psychologist;


use App\Enums\TypeServiceEnum;
use App\Repositories\PsychologistProgressProfileRepository;
use App\Repositories\PsychologistRepository;

class UpdatePsychologistPercentageProfileService
{
    private $psychologist_repository;
    private $psychologist_progress_profile_repository;

    public function __construct(
        PsychologistRepository $psychologist_repository,
        PsychologistProgressProfileRepository $psychologist_progress_profile_repository)
    {
        $this->psychologist_repository = $psychologist_repository;
        $this->psychologist_progress_profile_repository = $psychologist_progress_profile_repository;
    }

    public function execute(int $psychologist_id, string $type, int $value)
    {
        $action = 'add';
        $psychologist = $this->psychologist_repository->find($psychologist_id);

        $percentage = $psychologist->percentage_profile;
        $psychologist_progress_profile = $this->psychologist_progress_profile_repository
            ->getByPsychologistIdAndType($psychologist->id, $type)->first();

        if($psychologist_progress_profile && $value <= 0)
            $action = 'rem';

        if($psychologist_progress_profile && $action == 'add')
            return $percentage;

        if(!$psychologist)
            throw new \Exception("O Psicólogo não foi localizado", 500);

        if($action == 'add' && $psychologist->percentage_profile < 100){
            $this->psychologist_progress_profile_repository->store([
                'psychologist_id' => $psychologist->id,
                'type' => $type,
                'value' => $value,
                'is_active' => 1
            ]);
        }elseif($action == 'rem' && ($psychologist->percentage_profile >= 10 || $psychologist->percentage_profile >= 5)){
            $this->psychologist_progress_profile_repository->destroy($psychologist_progress_profile);
        }

        $percentage = $psychologist->percentage_profile + $value;

        if($percentage) {
            $data = ['percentage_profile' => $percentage];
            $this->psychologist_repository->update($psychologist, $data);
        }

        return $percentage;
    }
}
