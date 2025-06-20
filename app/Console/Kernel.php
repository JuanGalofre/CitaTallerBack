<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Symfony\Component\VarDumper\Server\DumpServer;

class Kernel extends ConsoleKernel
{
    /**
     * Las definiciones de los comandos de la consola de la aplicación.
     *
     * @var array
     */
    protected $commands = [
        DumpServer::class, // Registra el comando dump-server
    ];

    /**
     * Defina las programaciones de los comandos.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Aquí puedes agregar la programación de tus comandos
    }

    /**
     * Registra los comandos para la aplicación.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
