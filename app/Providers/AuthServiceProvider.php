<?php
namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
    ];

    public function boot()
    {
        $this->registerPolicies();


        //El usuario se pasa de forma implicita en las gates
        $esAdmin = function (User $usuario) {
            return $usuario->rol === 'admin';
        };

        //Solo administradores pueden obtener todas las citas
        Gate::define('obtener-todas-citas', $esAdmin);

        //Solo administradores o el usuario que la creo, puede editar una cita
        Gate::define('editar-citas', function ($usuarioAutenticado, $cita) use ($esAdmin) {
            // Compara si el usuario autenticado es admin o es el propietario de la cita
            return ($esAdmin($usuarioAutenticado)) || ($usuarioAutenticado->id === $cita->user_id);
        });

        //Solo administradores pueden eliminar citas
        Gate::define('eliminar-citas', $esAdmin);

    }
}
