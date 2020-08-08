<?php


namespace App\Repositories;


use App\User;

class UserRepository
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function store($user)
    {
        return  $this->model::create($user);
    }

    public function getUserByEmailOrCPF($column, $data)
    {
        return $this->model::where($column, $data)->first();
    }
}
