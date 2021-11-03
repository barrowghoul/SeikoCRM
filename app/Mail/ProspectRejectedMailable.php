<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProspectRejectedMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "Su solicitud de nuevo prospecto ha sido rechazada";
    public $prospect, $asigned;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($prospect)
    {
        $this->prospect = $prospect;
        $this->asigned = User::find($prospect->created_by);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('crm@seikosoluciones.com')->subject($this->subject)->view('emails.prospect.rejected');
    }
}
