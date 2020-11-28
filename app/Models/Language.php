<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes;

    public function psychologists()
    {
        return $this->belongsToMany('App\Models\Psychologist', 'psychologist_languages',
            'language_id', 'psychologist_id');
    }
}
