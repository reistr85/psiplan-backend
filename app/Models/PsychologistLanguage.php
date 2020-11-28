<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsychologistLanguage extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'language_id', 'is_active'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActiveScope());
    }

    public function language(){
        return $this->belongsTo(Language::class);
    }

    public function psychologist(){
        return $this->belongsTo(Psychologist::class);
    }
}
