<?php


namespace App\Observers\API\v1;


use App\Models\PsychologistServiceAddress;

class PsychologistServiceAddressObserver
{
    public function creating(PsychologistServiceAddress $psychologistServiceAddress)
    {
        $psychologistServiceAddress->is_active = 1;
    }
}
