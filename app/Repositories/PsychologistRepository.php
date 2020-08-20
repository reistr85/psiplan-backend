<?php


namespace App\Repositories;


use App\Models\Psychologist;
use Illuminate\Support\Facades\DB;

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
                $this->filters($query, $params['languages'], 'psychologist_languages.language_id');
            })->join('psychologist_specialties', function ($query) use($params) {
                $query->on('psychologist_specialties.psychologist_id', '=', 'psychologists.id');
                $this->filters($query, $params['specialties'], 'psychologist_specialties.specialty_id');
            })->join('psychologist_genres', function ($query) use($params) {
                $query->on('psychologist_genres.psychologist_id', '=', 'psychologists.id');
                $this->filters($query, $params['genres'], 'psychologist_genres.genre_id');
            })->join('psychologist_target_audiences', function ($query) use($params) {
                $query->on('psychologist_target_audiences.psychologist_id', '=', 'psychologists.id');
                $this->filters($query, $params['target_audiences'], 'psychologist_target_audiences.target_audience_id');
            })->join('cities', 'psychologists.city_id', 'cities.id')
            ->with(['psychologist_languages.language', 'psychologist_specialties.specialty',
                'psychologist_genres.genre', 'psychologist_target_audiences.target_audience'])
            ->where('psychologists.city_id', $params['city_id'])
            ->orderBy('consultation_value', $params['order_price']);

        return  $query;
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
            'cities.name',
            'cities.state',
            'psychologists.is_active',
        ];
    }

    private function filters(&$query, $params, $column)
    {
        $ids = explode(',', $params);
        $query->whereIn($column, $ids);
    }
}
