<?php


namespace App\Services\API\v1\Auth;


use App\Repositories\LanguageRepository;

class GetAllLanguagesService extends LanguageRepository
{
    public function execute()
    {
        return parent::all();
    }
}
