<?php


namespace App\Services\API\v1\TargetAudience;


use App\Repositories\TargetAudienceRepository;

class GetAllTargetAudiencesService extends TargetAudienceRepository
{
    public function execute()
    {
        return parent::all();
    }
}
