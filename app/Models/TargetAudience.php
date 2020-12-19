<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TargetAudience extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActiveScope());
    }

    public function psychologists()
    {
        return $this->belongsToMany('App\Models\Psychologist', 'psychologist_target_audiences',
            'audience_id', 'psychologist_id');
    }
}
