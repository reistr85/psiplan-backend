<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagarmeSubscription extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'plan_id', 'pagarme_subscription_id', 'status', 'is_active'];
}
