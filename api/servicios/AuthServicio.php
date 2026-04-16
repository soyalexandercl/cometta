<?php

namespace Servicios;

class AuthServicio
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function autenticar($datos)
    {
        // Lógica para autenticar a un usuario
    }
}