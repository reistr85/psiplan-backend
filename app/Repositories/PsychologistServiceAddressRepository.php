<?php


namespace App\Repositories;


use App\Models\PsychologistServiceAddress;

class PsychologistServiceAddressRepository extends BaseRepository
{
    private $model;

    public function __construct(PsychologistServiceAddress $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return parent::findAll($this->model);
    }

    public function getPsychologistServiceAddressByPsychologistId(int $psychologist_id)
    {
        return $this->model::where('psychologist_id', $psychologist_id)->first();
    }

    public function store(array $data)
    {
        return parent::save($this->model, $data);
    }

    public function destroy(PsychologistServiceAddress $psychologistServiceAddress)
    {
        return parent::delete($psychologistServiceAddress);
    }
}
