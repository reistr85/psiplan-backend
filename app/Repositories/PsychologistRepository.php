<?php


namespace App\Repositories;


use App\Models\Psychologist;

class PsychologistRepository
{
    private $model;

    public function __construct(Psychologist $model)
    {
        $this->model = $model;
    }

    public function index($params)
    {
        return  $this->model::all();
    }
}
