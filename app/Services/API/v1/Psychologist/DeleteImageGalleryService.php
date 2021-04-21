<?php


namespace App\Services\API\v1\Psychologist;


use App\Models\Psychologist;
use App\Repositories\PsychologistRepository;

class DeleteImageGalleryService
{
    private $psychologist_repository;

    public function __construct(
        PsychologistRepository $psychologist_repository)
    {
        $this->psychologist_repository = $psychologist_repository;
    }

    public function execute(Psychologist $psychologist, array $data)
    {
        return $this->psychologist_repository->edit($psychologist, $data);
    }
}
