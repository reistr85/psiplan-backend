<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagarmeSubscription extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'psychologist_plan_id', 'subscription_id', 'status', 'is_active'];

    public function psychologistPlan()
    {
        return $this->belongsTo(PsychologistPlan::class);
    }
}
