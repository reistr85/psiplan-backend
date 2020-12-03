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
    public function execute(Psychologist $psychologist, array $data, string $action = null): string
    {
        if(array_key_exists("image", $data)){
            $path = null;
            $path_file_delete = null;
            $uploadService = new UploadImagesService();
            $width = 800;
            $height = 600;

            if($action === 'avatar'){
                $width = 300;
                $height = 300;
                $path = "images/users/{$psychologist->id}/avatar";
                $path_file_delete = "{$path}/{$psychologist->avatar}";
            }else if($action === 'image_gallery_one'){
                $path = "images/users/{$psychologist->id}/avatar";
                $path_file_delete = "{$path}/{$psychologist->avatar}";
            }


            Storage::disk('s3')->delete($path_file_delete);
            $name_image = $uploadService->execute($path, $data['image'], $width, $height);
            $data[$action] = $name_image;
        }

        $psi = parent::update($psychologist, $data);

        if(!$psi)
            throw new Exception("Erro ao alterar a(s) informação(s).", 500);

        return array_key_exists("image", $data) ? $data[$action] : null;
    }
}
