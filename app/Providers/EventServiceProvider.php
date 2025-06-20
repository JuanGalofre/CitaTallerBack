<?php
namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\CitaGenerada;
use App\Listeners\EnviarNotificacionCita;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Los mapeos de eventos a sus listeners.
     *
     * @var array
     */
    protected $listen = [
        CitaGenerada::class => [
            EnviarNotificacionCita::class,
        ],
    ];

    /**
     * Registra cualquier servicio de eventos.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
