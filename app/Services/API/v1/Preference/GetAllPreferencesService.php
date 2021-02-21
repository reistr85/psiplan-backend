<?php


namespace App\Services\API\v1\Preference;


use App\Repositories\PreferenceRepository;

class GetAllPreferencesService extends PreferenceRepository
{
    public function execute()
    {
        return parent::all();
    }
}
