<?php


namespace App\Observers\API\v1;

use App\Models\Evaluation;

class EvaluationObserver
{
    public function creating(Evaluation $evaluation)
    {
        $evaluation->is_active = 1;
    }
}
