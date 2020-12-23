<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistDocumentRepository;
use Illuminate\Support\Facades\Storage;

class CreatePsychologistDocumentService extends PsychologistDocumentRepository
{
    public function execute($psychologist_id, $files)
    {
        $data['psychologist_id'] = $psychologist_id;
        $psychologist_document = parent::getByPsychologistId($psychologist_id)->first();

        foreach($files as $key => $file){
            if($file) {
                $name = uniqid(date('HisYmd'));
                $extension = $file->extension();
                $nameFile = "{$name}.{$extension}";
                $data[$key] = $nameFile;
                $data["status_{$key}"] = 1;

                $file->storeAs("/documents/{$psychologist_id}/", $nameFile);
            }
        }

        if($psychologist_document->first())
            return parent::update($psychologist_document, $data);

        return parent::store($data);
    }
}
