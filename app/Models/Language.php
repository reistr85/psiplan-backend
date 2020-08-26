<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public function psychologists()
    {
        return $this->belongsToMany('App\Models\Psychologist', 'psychologist_languages',
            'language_id', 'psychologist_id');
    }
}
