<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagarmeSubscriptionTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'pagarme_subscription_id', 'transaction_id', 'status', 'amount', 'is_active'];

    public function plan()
    {
        return $this->belongsToMany('App\Models\Plan','psychologist_plans',
            'psychologist_id', 'plan_id')->whereNull('psychologist_plans.deleted_at');
    }

    public function subscription(){
        return $this->belongsTo(PagarmeSubscription::class, 'pagarme_subscription_id');
    }
}
