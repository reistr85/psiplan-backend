<?php


namespace App\Services\API\v1\Psychologist;


use App\Models\Psychologist;
use App\Repositories\PsychologistRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class UpdatePsychologistService extends PsychologistRepository
{
    /**
     * Update Psychologist
     *
     * @param Psychologist $psychologist
     * @param array $data
     * @param string $action
     * @return string
     * @throws Exception
     */
    public function execute(Psychologist $psychologist, array $data, string $action): string
    {
        if($action === 'avatar'){
            $file = $data['avatar'];
            $path = "images/users/{$psychologist->id}/avatar";
            $name_image = uniqid(date('HisYmd')) . ".pdf";
            $data['avatar'] = $name_image;

            Storage::disk('s3')->delete($path."/".$psychologist->avatar);

            $avatar = Image::make($file)->crop(300,300);
            $avatar = $avatar->stream();
            $storagePath = Storage::disk('s3')->put("{$path}/{$name_image}", $avatar->__toString(), 'public');

            if(!$storagePath)
                throw new Exception("Erro ao salvar o avatar.", 500);

        }

        $psi = parent::update($psychologist, $data);

        if(!$psi)
            throw new Exception("Erro ao alterar a(s) informação(s).", 500);

        return $data['avatar'];
    }
}
