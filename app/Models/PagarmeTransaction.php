<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagarmeTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'transaction_id', 'query_id', 'status', 'amount', 'is_active'];

    public function queries()
    {
        return $this->belongsTo(Query::class, 'query_id', 'id', 'queries');
    }
}
