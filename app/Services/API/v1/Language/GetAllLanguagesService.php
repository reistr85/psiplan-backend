<?php


namespace App\Services\API\v1\Language;


use App\Repositories\LanguageRepository;

class GetAllLanguagesService extends LanguageRepository
{
    public function execute()
    {
        return parent::all();
    }
}
