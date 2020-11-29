<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Psychologist extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'city_id', 'name', 'email', 'birth', 'cpf', 'phone', 'country', 'consultation_value',
        'consultation_duration', 'social_consultation_value', 'first_free_consultation', 'description', 'approach', 'avatar',
        'crp', 'pis', 'bank', 'agency', 'type_account', 'number_account', 'cpf_holder_account', 'cnpj_holder_account',
        'is_active'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActiveScope());
    }

    public function psychologist_languages(){
        return $this->hasMany(PsychologistLanguage::class);
    }

    public function psychologist_specialties(){
        return $this->hasMany(PsychologistSpecialty::class);
    }

    public function psychologist_genres(){
        return $this->hasMany(PsychologistGenre::class);
    }

    public function psychologist_target_audiences(){
        return $this->hasMany(PsychologistTargetAudience::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function languages()
    {
        return $this->belongsToMany('App\Models\Language','psychologist_languages',
            'psychologist_id', 'language_id');
    }
}
