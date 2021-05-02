<?php

namespace App\Models;

use App\Repositories\QueryRepository;
use App\Scopes\ActiveScope;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Psychologist extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'city_id', 'plan_id', 'state', 'name', 'email', 'birth', 'cpf', 'phone', 'country', 'consultation_value',
        'consultation_duration', 'social_consultation_value', 'first_free_consultation', 'consultation_package', 'consultation_package_value',
        'voluntary_service',  'profile_consultation_value', 'libras', 'accessibility', 'description', 'approach', 'avatar',
        'gallery_one', 'gallery_tow', 'gallery_three', 'gallery_four', 'gallery_five', 'url_youtube', 'platform_zoom',
        'platform_skype', 'platform_hangouts', 'platform_whatsapp', 'crp', 'pis', 'recipient_id', 'percentage_profile', 'complete_profile', 'is_active'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActiveScope());
    }

    public function psychologistGenres(){
        return $this->hasMany(PsychologistGenre::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function specialties()
    {
        return $this->belongsToMany('App\Models\Specialty','psychologist_specialties',
            'psychologist_id', 'specialty_id')->whereNull('psychologist_specialties.deleted_at');
    }

    public function typeServices()
    {
        return $this->belongsToMany('App\Models\TypeService','psychologist_type_services',
            'psychologist_id', 'type_service_id')->whereNull('psychologist_type_services.deleted_at');
    }

    public function targetAudiences()
    {
        return $this->belongsToMany('App\Models\TargetAudience','psychologist_target_audiences',
            'psychologist_id', 'target_audience_id')->whereNull('psychologist_target_audiences.deleted_at');
    }

    public function languages()
    {
        return $this->belongsToMany('App\Models\Language','psychologist_languages',
            'psychologist_id', 'language_id')->whereNull('psychologist_languages.deleted_at');
    }

    public function documents()
    {
        return $this->hasOne(PsychologistDocument::class);
    }

    public function videoPlatforms()
    {
        return $this->belongsToMany('App\Models\VideoPlatform','psychologist_video_platforms',
            'psychologist_id', 'video_platform_id')->whereNull('psychologist_video_platforms.deleted_at');
    }

    public function academicFormations()
    {
        return $this->hasMany(PsychologistAcademicFormation::class);
    }

    public function serviceAddress()
    {
        return $this->hasOne(PsychologistServiceAddress::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plans()
    {
        return $this->hasMany(PsychologistPlan::class);
    }

    public function address()
    {
        return $this->hasOne(PsychologistAddress::class);
    }

    public function availabilityCalendars()
    {
        return $this->hasMany(PsychologistAvailabilityCalendar::class);
    }

    public function psychologistAvailabilityCalendarByDayHourAndTypeServiceIdAndAvailabilityNull(
        string $psychologist_id, string $day_hour, string $type_service_id)
    {
        return PsychologistAvailabilityCalendar::where('psychologist_id', $psychologist_id)
            ->where('day_hour', $day_hour)
            ->where('type_service_id', $type_service_id)
            ->whereNull('available');

    }

    public function bank()
    {
        return $this->hasOne(PsychologistBank::class);
    }

    public function queries()
    {
        return $this->hasMany(Query::class);
    }

    public function pagarmeSubscriptionTransactions()
    {
        return $this->hasMany(PagarmeSubscriptionTransaction::class);
    }

    public function stars()
    {
        $queries = $this->queries()->with('star')->get();
        $stars = 0;

        foreach ($queries as $query){
            if($query->star)
                $stars += $query->star->star;
        }

        $qtd_queries = $queries->count();
        $number_of_possible_stars = $qtd_queries * 5;

        if(!$number_of_possible_stars)
            return 5;

        $percentage_star = $stars / $number_of_possible_stars;
        $qtd_stars = ceil(($percentage_star * 5));

        return $qtd_stars;
    }

    public function getPsychologistAvailabilityCalendarAndAvailabilityNull($psychologist_id)
    {
        return PsychologistAvailabilityCalendar::where('psychologist_id', $psychologist_id)
            ->whereNull('available');
    }
}
