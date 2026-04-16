<?php

namespace Controladores;

use Servicios\AuthServicio;

class AuthControlador extends Controlador
{
    private $authServicio;

    public function __construct()
    {
        $this->authServicio = new AuthServicio($this->conexion);
    }

    public function registro()
    {
        // Lógica para registrar un nuevo usuario
    }

    public function login()
    {
        // Lógica para autenticar a un usuario
        $datos = json_decode(file_get_contents('php://input'), true);

        $resultado = $this->authServicio->autenticar($datos);
    }
}