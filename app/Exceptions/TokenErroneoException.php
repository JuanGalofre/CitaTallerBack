<?php

namespace App\Exceptions;

use Exception;

class TokenErroneoException extends Exception
{
    protected $mensaje = "Hubo un problema con el token del usuario";
    //De este no estoy tan seguro
    protected $codigo = 401;
    public function __construct($mensaje = null, $codigo = null)
    {
        $this->mensaje = $mensaje ?: $this->mensaje;
        $this->codigo = $codigo ?: $this->codigo;

        parent::__construct($this->mensaje, $this->codigo);
    }

}
