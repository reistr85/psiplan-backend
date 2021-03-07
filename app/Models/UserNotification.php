<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $fillable = ['user_id', 'type_user', 'notification_id', 'title', 'description', 'url', 'url_children', 'status', 'is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
