<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{

    use SoftDeletes;

    protected $fillable = ['user_id', 'name', 'email', 'phone', 'cpf', 'cep', 'state', 'city', 'neighborhood',
        'street', 'number', 'complement', 'is_active'];
}
