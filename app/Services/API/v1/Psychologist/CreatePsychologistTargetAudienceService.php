<?php


namespace App\Services\API\v1\Psychologist;


use App\Models\PsychologistTypeService;
use App\Repositories\PsychologistTargetAudienceRepository;
use App\Repositories\PsychologistTypeServiceRepository;

class CreatePsychologistTargetAudienceService extends PsychologistTargetAudienceRepository
{
    public function execute(int $psychologist_id, array $target_audiences)
    {
        $psychologist_target_audiences = parent::getPsychologistTargetAudienceByPsychologistId($psychologist_id)->get();

        foreach($psychologist_target_audiences as $psychologist_target_audience){
            parent::destroy($psychologist_target_audience);
        }

        foreach($target_audiences as $key => $target_audience){
            $psychologist_target_audience = [
                'psychologist_id' => $psychologist_id,
                'target_audience_id' => $target_audience['id'],
            ];

            parent::store($psychologist_target_audience);
        }
    }
}
