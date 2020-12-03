<?php


namespace App\Services\API\v1\Psychologist;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Exception;

class UploadImagesService
{

    private $width;
    private $height;

    /**
     * Construct UploadImageService
     *
     * @param int $width
     * @param int $height
     */
    public function __construct(int $width = 800, int $height = 600)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Execute of UploadImageService
     *
     * @param string $path
     * @param $file
     * @return string
     * @throws Exception
     */
    public function execute($path, $file): string
    {
        $name_image = uniqid(date('HisYmd')) . ".jpg";
        $image = Image::make($file)->crop($this->width, $this->height);
        $image = $image->stream();
        $storagePath = Storage::disk('s3')->put("{$path}/{$name_image}", $image->__toString(), 'public');

        if(!$storagePath)
            throw new Exception("Erro ao fazer o upload da imagem.", 500);

        return $name_image;
    }
}
