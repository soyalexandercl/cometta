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
        $this->conexion = new Conexion();

        $this->transaccion = new Transaccion($this->conexion);
    }
}