<?php


namespace App\Repositories;

use App\Models\Psychologist;
use Facade\Ignition\QueryRecorder\Query;

class PsychologistRepository
{
    private $model;
    private $columns_filters = ['specialties_id'];

    public function __construct(Psychologist $model)
    {
        $this->model = $model;
    }

    public function index($params)
    {
        $query = $this->model::select($this->getResumeColumns())->distinct('psychologists.id')
            ->join('psychologist_languages', function ($query) use($params) {
                $query->on('psychologist_languages.psychologist_id', '=', 'psychologists.id');
            })->join('psychologist_specialties', function ($query) use($params) {
                $query->on('psychologist_specialties.psychologist_id', '=', 'psychologists.id');
            })->join('psychologist_genres', function ($query) use($params) {
                $query->on('psychologist_genres.psychologist_id', '=', 'psychologists.id');
                $this->filters($query, $params['genre_id'], 'psychologist_genres.genre_id', 'psychologist_genres');
            })->join('psychologist_target_audiences', function ($query) use($params) {
                $query->on('psychologist_target_audiences.psychologist_id', '=', 'psychologists.id');
                $this->filters($query, $params['target_audience_id'], 'psychologist_target_audiences.target_audience_id', 'psychologist_target_audiences');
            })->join('cities', 'psychologists.city_id', 'cities.id')
            ->with(['languages']);

            if($params['city_id'])
                $query->where('psychologists.city_id', $params['city_id']);

            if($params['order_price'])
                $query->orderBy('consultation_value', $params['order_price']);

        return  $query;
    }

    public function store($data)
    {
        return $this->model::create($data);
    }

    public function update(Psychologist $psychologist, $data)
    {
        return $psychologist->update($data);
    }

    private function getResumeColumns()
    {
        return [
            'psychologists.id',
            'psychologists.avatar',
            'psychologists.consultation_value',
            'psychologists.consultation_duration',
            'psychologists.name',
            'psychologists.description',
            'psychologists.crp',
            'cities.description as city',
            'cities.state as state',
            'psychologists.is_active',
        ];
    }

    private function filters(&$query, $params, $column, $table)
    {
        if($params) {
            $ids = explode(',', $params);
            $query->whereIn($column, $ids)->whereNull($table.'.deleted_at');
        }
    }

    public function getByUserId($user_id)
    {
        return $this->model->where('user_id', $user_id)->first();
    }

    /**
     * Get All Specialties by Psychologist Id.
     *
     * @param int $psychologist_id
     * @return Query
     */
    public function getSpecialities($psychologist_id)
    {
        return $this->model->select('specialties.*')
            ->join('psychologist_specialties', 'psychologist_specialties.psychologist_id', 'psychologists.id')
            ->join('specialties', 'psychologist_specialties.specialty_id', 'specialties.id')
            ->where('psychologist_specialties.psychologist_id', $psychologist_id)->whereNull('psychologist_specialties.deleted_at');
    }
}
