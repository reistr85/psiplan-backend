<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsychologistVideoPlatform extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'video_platform_id', 'is_active'];
}
