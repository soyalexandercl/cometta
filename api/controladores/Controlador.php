<?php

namespace Controladores;

use Nucleo\Conexion;
use Nucleo\Transaccion;

class Controlador
{
    protected $conexion;
    protected $transaccion;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conexion = $conexion->obtenerConexion();
        $this->transaccion = new Transaccion($this->conexion);
    }
}