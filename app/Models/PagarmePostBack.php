<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagarmePostBack extends Model
{
    use SoftDeletes;

    protected $fillable = ['pagarme_post_back_type', 'pagarme_post_back_id', 'postback_id', 'postback_event', 'postback_object',
        'postback_old_status', 'postback_current_status', 'postback_payload'];
}
