<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsychologistNotification extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'notification_id', 'is_active'];
}
