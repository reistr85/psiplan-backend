<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use stdClass;

class ConsultationFreePsychologist extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * Create a new message instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Nova Solicitação de Consulta Experimental - PSIPLAN Brasil');
        $this->to($this->data['psychologist_email'], $this->data['psychologist_name']);

        return $this->markdown('mails.consultation_free_psychologist', [
            'data' => $this->data
        ]);
    }
}
