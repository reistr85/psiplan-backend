<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewQueryPsychologist extends Mailable
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
        $this->subject('Nova consulta agendada - PSIPLAN Brasil');
        $this->to($this->data['email'], $this->data['name']);

        return $this->markdown('mails.new_query_psychologist', [
            'data' => $this->data
        ]);
    }
}
