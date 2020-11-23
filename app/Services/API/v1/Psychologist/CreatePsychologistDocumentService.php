<?php


namespace App\Services\API\v1\Psychologist;


class CreatePsychologistDocumentService
{
    public function execute($psychologist_id, $files)
    {
        $file = $files['fileCrp'];
        $file->store('products');
    }
}
