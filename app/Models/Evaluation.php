<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use SoftDeletes;

    protected $fillable = ['query_id', 'star', 'comment', 'is_active'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function querie()
    {
        return $this->belongsTo(Query::class, 'query_id', 'id', 'queries');
    }
}
