<?php


namespace App\Repositories;

use App\Models\Psychologist;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\Eloquent\Builder;
use PhpParser\Node\Expr\Cast\Object_;

class PsychologistRepository extends BaseRepository
{
    private $model;
    private $columns_filters = ['specialties_id'];

    public function __construct(Psychologist $model)
    {
        $this->model = $model;
    }

    public function find(int $id)
    {
        return parent::findById($this->model, $id);
    }

    public function index($params)
    {
        $query = $this->model::select($this->getResumeColumns())->distinct('psychologists.id')
            ->join('psychologist_specialties', function ($query) use($params) {
                $query->on('psychologist_specialties.psychologist_id', '=', 'psychologists.id');
            })->join('psychologist_target_audiences', function ($query) use($params) {
                $query->on('psychologist_target_audiences.psychologist_id', '=', 'psychologists.id');
                $this->filters($query, $params['target_audience_id'], 'psychologist_target_audiences.target_audience_id', 'psychologist_target_audiences');
            })->join('cities', 'psychologists.city_id', 'cities.id');

        if($params['text'])
            $query->where(function($query)use ($params){
                $query->orWhere('psychologists.name', 'like', '%' . $params['text'] . '%');
                $query->orWhere('psychologists.approach', 'like', '%' . $params['text'] . '%');
                $query->orWhere('cities.description', 'like', '%' . $params['text'] . '%');
            });

        if($params['target_audience_id'])
            $query->where('psychologist_target_audiences.target_audience_id', $params['target_audience_id'])->whereNull('psychologist_target_audiences.deleted_at');

        if($params['specialty_id'])
            $query->where('psychologist_specialties.specialty_id', $params['specialty_id'])->whereNull('psychologist_specialties.deleted_at');

        if($params['city_id'])
            $query->where('psychologists.city_id', $params['city_id'])->whereNull('cities.deleted_at');

        if($params['order_price'])
            $query->orderBy('consultation_value', $params['order_price']);

        return  $query;
    }

    public function store($data)
    {
        return $this->model::create($data);
    }

    private function getResumeColumns()
    {
        return [
            'psychologists.id',
            'psychologists.user_id',
            'psychologists.avatar',
            'psychologists.consultation_value',
            'psychologists.consultation_duration',
            'psychologists.first_free_consultation',
            'psychologists.consultation_package',
            'psychologists.libras',
            'psychologists.accessibility',
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

    public function getPsychologistByUserId($user_id)
    {
        return $this->model->select(
                "psychologists.*",
                "cities.state as state",
                "cities.description as city")
            ->where('user_id', $user_id)
            ->join('cities', 'cities.id',  'psychologists.city_id')
            ->with(['psychologist_languages.language'])->first();
    }

    /**
     * Get All Specialties by Psychologist Id.
     *
     * @param int $psychologist_id
     * @return Builder
     */
    public function getSpecialities($psychologist_id): Builder
    {
        return $this->model->select('specialties.*')
            ->join('psychologist_specialties', 'psychologist_specialties.psychologist_id', 'psychologists.id')
            ->join('specialties', 'psychologist_specialties.specialty_id', 'specialties.id')
            ->where('psychologist_specialties.psychologist_id', $psychologist_id)
            ->whereNull('psychologist_specialties.deleted_at');
    }

    /**
     * Get All Specialties by Psychologist Id.
     *
     * @param int $psychologist_id
     * @return Builder
     */
    public function getNotifications(int $psychologist_id): Builder
    {
        return $this->model->select('psychologist_notifications.*')
            ->join('psychologist_notifications', 'psychologist_notifications.psychologist_id', 'psychologists.id')
            ->join('notifications', 'psychologist_notifications.notification_id', 'notifications.id')
            ->where('psychologist_notifications.psychologist_id', $psychologist_id)
            ->where('psychologist_notifications.is_active', 1)
            ->whereNull('psychologist_notifications.deleted_at');
    }
}
