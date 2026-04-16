<?php

namespace Controladores;

use Controladores\Controlador;
use Servicios\AuthServicio;

class AuthControlador extends Controlador
{
    private $auth_servicio;

    public function __construct()
    {
        parent::__construct();

        $this->auth_servicio = new AuthServicio($this->conexion);
    }

    public function iniciarSesion()
    {
        $datos = json_decode(file_get_contents('php://input'), true);

        $resultado = $this->auth_servicio->iniciarSesion($datos);

        echo json_encode($resultado);
    }

    public function registrarUsuario()
    {
        $datos = json_decode(file_get_contents('php://input'), true);

        // $resultado = $this->auth_servicio->registrarUsuario($datos);

        echo json_encode($datos);
    }
}