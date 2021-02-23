<?php


namespace App\Repositories;


use App\Models\City;
use App\Models\UserNotification;
use Illuminate\Database\Eloquent\Builder;

class UserNotificationRepository extends BaseRepository
{
    private $model;

    public function __construct(UserNotification $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return parent::findAll($this->model);
    }

    public function getAllNotReadByUserId(int $user_id)
    {
        return $this->model->where('user_id', $user_id)->where('status', 'not_read');
    }
}
