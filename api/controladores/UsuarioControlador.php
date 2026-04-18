<?php

namespace Controladores;

use Servicios\UsuarioServicio;

class UsuarioControlador extends Controlador
{
    private $usuario_servicio;

    public function __construct()
    {
        parent::__construct();

        $this->usuario_servicio = new UsuarioServicio($this->conexion);
    }
}