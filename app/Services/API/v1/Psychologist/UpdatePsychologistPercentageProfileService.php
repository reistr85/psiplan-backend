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

    public function execute(int $psychologist_id, string $action, string $type, int $value)
    {
        $psychologist = $this->psychologist_repository->find($psychologist_id);

        if($type == 'avatar' && ($psychologist->plan_id == TypeServiceEnum::PLAN_ID_PREMIUM_TRI ||
            $psychologist->plan_id == TypeServiceEnum::PLAN_ID_PREMIUM_SEM))
            $value = 10;

        $percentage = $psychologist->percentage_profile;
        $psychologist_progress_profile = $this->psychologist_progress_profile_repository
            ->getByPsychologistIdAndType($psychologist->id, $type)->first();

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
            $percentage = $psychologist->percentage_profile + $value;
        }elseif($action == 'rem' && $psychologist->percentage_profile >= 10){
            $percentage = $psychologist->percentage_profile - $value;
        }

        if($percentage) {
            $data = ['percentage_profile' => $percentage];

            if($percentage == 100)
                $data['complete_profile'] = 'complete';

            $this->psychologist_repository->update($psychologist, $data);
        }

        return $percentage;
    }
}
