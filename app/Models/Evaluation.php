<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use SoftDeletes;

    protected $fillable = ['query_id', 'client_id', 'psychologist_id', 'star', 'comment', 'is_active'];
}
