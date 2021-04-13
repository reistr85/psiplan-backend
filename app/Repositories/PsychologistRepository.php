<?php


namespace App\Repositories;

use App\Models\Psychologist;
use App\Models\PsychologistAddress;
use Illuminate\Database\Eloquent\Builder;

class PsychologistRepository extends BaseRepository
{
    private $model;
    private $columns_filters = ['specialties_id'];

    public function __construct(Psychologist $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model;
    }

    public function find(int $id)
    {
        return parent::findById($this->model, $id);
    }

    public function getPsychologist($id)
    {
        return $this->model->where('id', $id)
          ->whereNotNull('psychologists.plan_id');
    }

    public function index($params)
    {
        $query = $this->model
            ->select(\DB::raw("DISTINCT psychologists.id, ".implode(', ', $this->getResumeColumns())))
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
            $query->where('psychologists.city_id', $params['city_id'])
                ->whereNull('cities.deleted_at');

        if($params['first_consultation'] == 'true')
            $query->where('psychologists.first_free_consultation', 1);

        $query->where('psychologists.complete_profile', 'completed')
              ->whereNotNull('psychologists.plan_id');

        if($params['order_price'])
            $query->orderBy('psychologists.consultation_value', $params['order_price']);

        return  $query;
    }

    public function getLastAvailabilityCalendar()
    {

    }

    public function store($data)
    {
        return $this->model::create($data);
    }

    private function getResumeColumns()
    {
        return [
            'psychologists.user_id',
            'psychologists.plan_id',
            'psychologists.avatar',
            'psychologists.consultation_value',
            'psychologists.consultation_duration',
            'psychologists.first_free_consultation',
            'psychologists.profile_consultation_value',
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
            ->with([
                'languages',
                'specialties',
                'targetAudiences',
                'academicFormations',
                'serviceAddress',
                'typeServices',
                'videoPlatforms',
                'address'
            ])->first();
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
        return $this->model->select('psychologist_preferences.*')
            ->join('psychologist_preferences', 'psychologist_preferences.psychologist_id', 'psychologists.id')
            ->join('preferences', 'psychologist_preferences.preference_id', 'preferences.id')
            ->where('psychologist_preferences.psychologist_id', $psychologist_id)
            ->where('psychologist_preferences.is_active', 1)
            ->whereNull('psychologist_preferences.deleted_at');
    }

    public function getAllTypeServicesByPsychologistIdService(int $psychologist_id)
    {
        return $this->model->find($psychologist_id)->typeServices;
    }

    public function getPsychologistAvailabilityCalendarByDayHourAndTypeServiceIdAndAvailabilityNull(
        string $psychologist_id, string $day_hour, string $type_service_id)
    {
        return $this->model->psychologistAvailabilityCalendarByDayHourAndTypeServiceIdAndAvailabilityNull(
            $psychologist_id, $day_hour, $type_service_id);
    }

    public function createPsychologistAddress(PsychologistAddress $model, array $data)
    {
        return parent::save($model, $data);
    }

    public function updatePsychologistAddress(PsychologistAddress $model, array $data)
    {
        return parent::update($model, $data);
    }

    public function edit(Psychologist $model, array $data)
    {
        return parent::update($model, $data);
    }

    public function verifyExistentPsychologistByCRP($id, $data)
    {
        if(array_key_exists('crp', $data)) {
            if ($this->model->where('crp', $data['crp'])->where('id', '!=', $id)->whereNull('deleted_at')->first())
                return true;
        }

        return false;
    }

    public function verifyExistentPsychologistByPIS($id, $data)
    {
        if(array_key_exists('pis', $data)) {
            if ($this->model->where('pis', $data['pis'])->where('id', '!=', $id)->whereNull('deleted_at')->first())
                return true;
        }

        return false;
    }
}
