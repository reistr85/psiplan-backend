<?php


namespace App\Observers\API\v1;

use App\Models\PsychologistDocument;

class PsychologistDocumentsObserver
{
    public function creating(PsychologistDocument $psychologistDocument)
    {
        $psychologistDocument->is_active = 1;
    }
}
