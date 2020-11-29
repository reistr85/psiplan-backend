<?php


namespace App\Repositories;


use App\Models\PsychologistNotification;
use Illuminate\Database\Eloquent\Builder;

class PsychologistNotificationRepository extends BaseRepository
{
    private $model;

    public function __construct(PsychologistNotification $model)
    {
        $this->model = $model;
    }

    /**
     * Update PsychologistNotification
     *
     * @param int $psychologist_id
     * @param int $notification_id
     * @return Builder
     * */
    public function getPsychologistNotificationByPsychologistIdAndNotificationId(int $psychologist_id, int $notification_id): Builder
    {
        return $this->model::where('psychologist_id', $psychologist_id)->where('notification_id', $notification_id);
    }
}
