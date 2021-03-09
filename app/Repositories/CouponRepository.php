<?php


namespace App\Repositories;


use App\Models\Coupon;
use Illuminate\Database\Eloquent\Builder;

class CouponRepository extends BaseRepository
{
    private $model;

    public function __construct(Coupon $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return parent::findAll($this->model);
    }

    public function find($id)
    {
        return parent::findById($this->model, $id);
    }

    public function store(array $data)
    {
        return parent::save($this->model, $data);
    }

    public function edit($model, $data)
    {
        return parent::update($model, $data);
    }

    public function getAllCouponsByQueryId(int $query_id)
    {
        return $this->model->where('query_id', $query_id);
    }

    public function getCouponByCoupon(int $coupon)
    {
        return $this->model->where('coupon', $coupon);
    }

    public function getAllCouponsByClientId(int $client_id)
    {
        return $this->model->where('client_id', $client_id);
    }
}
