<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistRepository;

class GetPsychologistByUserIdService extends PsychologistRepository
{
    public function execute(int $id)
    {
        $psy = parent::find($id);
        $psychologist = parent::getPsychologistByUserId($psy->user_id);

        if(!$psychologist->complete_profile)
            throw new \Exception("Psicólogo não encontrado", 500);

        $path_avatar = env('AWS_BASE_URL')."/images/users/{$psy->user_id}/avatar/";
        $path_gallery = env('AWS_BASE_URL')."/images/users/{$psy->user_id}/gallery/";


        $psychologist->avatar = $psychologist->avatar ? $path_avatar.$psychologist->avatar : env('AWS_BASE_URL')."/images/Avatar.png";
        $psychologist->gallery_one = $psychologist->gallery_one ? $path_gallery.$psychologist->gallery_one : null;
        $psychologist->gallery_tow = $psychologist->gallery_tow ? $path_gallery.$psychologist->gallery_tow : null;
        $psychologist->gallery_three = $psychologist->gallery_three ? $path_gallery.$psychologist->gallery_three : null;
        $psychologist->gallery_four = $psychologist->gallery_four ? $path_gallery.$psychologist->gallery_four : null;
        $psychologist->gallery_five = $psychologist->gallery_five ? $path_gallery.$psychologist->gallery_five : null;

        return $psychologist;
    }
}
