<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistRepository;
use App\Repositories\PsychologistVideoPlatformRepository;
use App\Repositories\VideoPlatformRepository;

class CreatePsychologistVideosPlatformService
{
    private $psychologist_repository;
    private $psychologist_video_platform_repository;

    public function __construct(
        PsychologistRepository $psychologist_repository,
        PsychologistVideoPlatformRepository $psychologist_video_platform_repository)
    {
        $this->psychologist_repository = $psychologist_repository;
        $this->psychologist_video_platform_repository = $psychologist_video_platform_repository;
    }

    public function execute($psychologist, array $data)
    {
        $arr = [];

        if($data['platform_whatsapp'])
            array_push($arr, ['psychologist_id' => $psychologist->id, 'video_platform_id' => 1, 'is_active' => 1]);

        if($data['platform_skype'])
            array_push($arr, ['psychologist_id' => $psychologist->id, 'video_platform_id' => 2, 'is_active' => 1]);

        if($data['platform_hangouts'])
            array_push($arr, ['psychologist_id' => $psychologist->id, 'video_platform_id' => 3, 'is_active' => 1]);

        if($data['platform_zoom'])
            array_push($arr, ['psychologist_id' => $psychologist->id, 'video_platform_id' => 4, 'is_active' => 1]);

        $psychologist_video_platforms = $this->psychologist_video_platform_repository->getByPsychologistId($psychologist->id);
        $psychologist_video_platforms->delete();

        foreach($arr as $key => $value){
            $this->psychologist_video_platform_repository->store($value);
        }
    }
}
