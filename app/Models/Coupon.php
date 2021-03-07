<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'client_id', 'query_id', 'coupon', 'situation', 'status_payment', 'source', 'is_active'];
}
