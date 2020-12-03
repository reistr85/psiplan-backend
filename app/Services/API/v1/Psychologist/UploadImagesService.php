<?php


namespace App\Services\API\v1\Psychologist;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Exception;

class UploadImagesService
{
    /**
     * Update Psychologist
     *
     * @param $path
     * @param $file
     * @param $width
     * @param $height
     * @return string
     * @throws Exception
     */
    public function execute($path, $file, $width, $height): string
    {
        $name_image = uniqid(date('HisYmd')) . ".pdf";
        $image = Image::make($file)->crop($width, $height);
        $image = $image->stream();
        $storagePath = Storage::disk('s3')->put("{$path}/{$name_image}", $image->__toString(), 'public');

        if(!$storagePath)
            throw new Exception("Erro ao fazer o upload da imagem.", 500);

        return $name_image;
    }
}
