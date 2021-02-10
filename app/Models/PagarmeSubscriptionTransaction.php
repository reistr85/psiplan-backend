<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagarmeSubscriptionTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'pagarme_subscription_id', 'pagarme_transaction_id', 'status', 'amount', 'is_active'];
}
