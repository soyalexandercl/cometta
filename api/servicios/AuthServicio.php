<?php

namespace Servicios;

class AuthServicios
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function autenticar($datos)
    {
        // Lógica para autenticar a un usuario

        echo "Autenticando con datos: " . json_encode($datos);
    }
}