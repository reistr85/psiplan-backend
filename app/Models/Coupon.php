<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['psychologist_id', 'client_id', 'coupon', 'situation', 'is_active'];
}
