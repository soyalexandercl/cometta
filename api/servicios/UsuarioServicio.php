<?php

namespace Servicios;

use Modelos\UsuarioModelo;
use Nucleo\Token;

class UsuarioServicio
{
    private $conexion;
    private $usuario_modelo;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
        $this->usuario_modelo = new UsuarioModelo($conexion);
    }
}