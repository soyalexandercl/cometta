<?php

namespace Controladores;

use Nucleo\Conexion;

class Controlador
{
    protected $conexion;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conexion = $conexion->obtenerConexion();
    }
}