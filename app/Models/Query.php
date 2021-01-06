<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Query extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function psychologist()
    {
        return $this->belongsTo(Psychologist::class);
    }
}
