<?php

namespace App\Listeners;

use App\Events\CitaGenerada;
use App\Mail\CitaRegistradaEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EnviarNotificacionCita
{

    public function handle(CitaGenerada $event): void
    {
        $cita = $event->cita;
        $usuario = User::find($event->cita->user_id);
        Mail::to($usuario->email)->send(new CitaRegistradaEmail($usuario,$cita));
    }
}
