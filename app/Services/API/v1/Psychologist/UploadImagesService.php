<?php


namespace App\Services\API\v1\Psychologist;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Exception;

class UploadImagesService
{

    private $width;
    private $height;
    private $thumbnail;

    /**
     * Construct UploadImageService
     *
     * @param int $width
     * @param int $height
     * @param bool $thumbnail
     */
    public function __construct(int $width = 800, int $height = 600, $thumbnail = false)
    {
        $this->width = $width;
        $this->height = $height;
        $this->thumbnail = $thumbnail;
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
//        $image = Image::make($file)->resize($this->width, $this->height);
        $image = Image::make($file)->resize($this->width, $this->height, function ($constraint) {
        })->encode('jpg');
        $image = $image->stream();
        $storagePath = Storage::disk('s3')->put("{$path}/{$name_image}", $image->__toString(), 'public');

        if($this->thumbnail){
            $image = Image::make($file)->resize(85, 85, function ($constraint) {
            })->encode('jpg');
            $image = $image->stream();
            $storagePath = Storage::disk('s3')->put("{$path}/thumbnail_{$name_image}", $image->__toString(), 'public');
        }

        if(!$storagePath)
            throw new Exception("Erro ao fazer o upload da imagem.", 500);

        return $name_image;
    }
}
