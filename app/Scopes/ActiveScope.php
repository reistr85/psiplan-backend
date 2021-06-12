<?php


namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ActiveScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if(explode('/', \Request::route()->uri())[3] != 'dashboard')
            $builder->where($model->getTable().'.is_active', 1);
    }
}
