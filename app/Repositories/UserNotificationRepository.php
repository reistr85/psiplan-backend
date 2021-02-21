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
}
