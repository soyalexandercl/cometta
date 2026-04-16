<?php

namespace Controladores;

use Controladores\Controlador;
use Servicios\AuthServicio;

class AuthControlador extends Controlador
{
    private $auth_servicio;

    public function __construct()
    {
        $this->auth_servicio = new AuthServicio($this->conexion);
    }

    public function login()
    {
        // Lógica para autenticar a un usuario
        $datos = json_decode(file_get_contents('php://input'), true);

        $resultado = $this->auth_servicio->autenticar($datos);

        echo json_encode($resultado);
    }

    public function registro()
    {
        // Lógica para registrar un nuevo usuario
    }
}