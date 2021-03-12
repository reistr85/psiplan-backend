<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{

    use SoftDeletes;

    protected $fillable = ['user_id', 'name', 'email', 'phone', 'cpf', 'birthday', 'cep', 'state', 'city', 'neighborhood',
        'street', 'number', 'first_consultation_status', 'is_active'];
}
