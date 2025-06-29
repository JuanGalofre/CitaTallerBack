<?php

namespace App\Mail;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CitaRegistradaEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $usuario;
    public $cita;

    /**
     * Create a new message instance.
     */
    public function __construct(User $usuario, Cita $cita)
    {
        $this->usuario = $usuario;
        $this->cita = $cita;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cita Registrada Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.citaRegistrada',
        );
    }

}
