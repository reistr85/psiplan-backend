<?php


namespace App\Repositories;


use App\Models\PsychologistAvailabilityCalendar;

class PsychologistAvailabilityCalendarRepository extends BaseRepository
{
    private $model;

    public function __construct(PsychologistAvailabilityCalendar $model)
    {
        $this->model = $model;
    }

    public function store(array $data)
    {
        return parent::save($this->model, $data);
    }
}
