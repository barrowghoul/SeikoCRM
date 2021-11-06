<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProspectApprovedMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "Su solicitud de creación de prospecto ha sido aprobada";
    public $prospect;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($prospect)
    {
        $this->prospect = $prospect;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('crm@seikosoluciones.com')->subject($this->subject)->view('emails.prospect.approved');
    }
}
