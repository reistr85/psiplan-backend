<?php


namespace App\Services\API\v1\Psychologist;


use App\Models\Psychologist;
use App\Repositories\PsychologistRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdatePsychologistService extends PsychologistRepository
{
    /**
     * Update Psychologist
     *
     * @param Psychologist $psychologist
     * @param array $data
     * @param string $action
     * @return bool
     * @throws Exception
     */
    public function execute(Psychologist $psychologist, array $data, string $action): bool
    {
        if($action === 'avatar'){
            Storage::deleteDirectory($psychologist->id."/avatar/");

            foreach($data as $key => $file){
                if($file) {
                    $name = uniqid(date('HisYmd'));
                    $extension = $file->extension();
                    $nameFile = "{$name}.{$extension}";
                    $data[$key] = $nameFile;

                    $file->storeAs($psychologist->id . "/avatar/", $nameFile);
                    $data['avatar'] = $nameFile;
                }
            }
        }

        $psi = parent::update($psychologist, $data);

        if(!$psi)
            throw new Exception("Erro ao alterar o psicólogo.", 500);

        return $psi;
    }
}
