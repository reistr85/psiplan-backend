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
    private $path;
    private $path_file_delete;
    private $uploadService;

    /**
     * Execute UpdatePsychologistService
     *
     * @param int $psychologist_id
     * @param array $data
     * @param string $action
     * @return string
     * @throws Exception
     */
    public function execute(int $psychologist_id, array $data, string $action = null): string
    {
        $psychologist = parent::find($psychologist_id);

        if(array_key_exists("image", $data)){
            if($action === 'avatar'){
                $this->uploadService = new UploadImagesService(300, 300);
                $this->path = "images/users/{$psychologist->id}/avatar";
                $this->path_file_delete = "{$this->path}/{$psychologist->avatar}";
            }else{
                $this->uploadService = new UploadImagesService(1024, 768, true);
                $this->path = "images/users/{$psychologist->id}/gallery";
                $this->path_file_delete = "{$this->path}/{$psychologist[$action]}";
                Storage::disk('s3')->delete("{$this->path}/thumbnail_{$psychologist[$action]}");
            }

            Storage::disk('s3')->delete("{$this->path_file_delete}");
            $name_image = $this->uploadService->execute($this->path, $data['image']);
            $data[$action] = $name_image;
        }

        if($action === 'delete_gallery')
            $data = [$data['type'] => null];

        $psi = parent::update($psychologist, $data);

        if(!$psi)
            throw new Exception("Erro ao alterar a(s) informação(s).", 500);

        return array_key_exists("image", $data) ? $data[$action] : '';
    }
}
