<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistLanguageRepository;

class CreatePsychologistLanguageService extends PsychologistLanguageRepository
{
    public function execute($psychologist_id, $languages)
    {
        if(!count($languages))
            throw new \Exception("É preciso selecionar pelo menos um idioma.", 500);


        $psychologist_languages = parent::getAllByPsychologistId($psychologist_id)->get();

        $psychologist_languages->map(function($item) {
            parent::destroy($item);
        });

        foreach($languages as $language){
            $data = [
                'psychologist_id' => $psychologist_id,
                'language_id' => $language['id'],
            ];

            $psychologist_language = parent::store($data);

            if(!$psychologist_language)
                throw new \Exception("Erro ao registrar os idiomas. Tente novamente.", 500);
        }
    }
}
