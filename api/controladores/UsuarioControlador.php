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

    public function registrarConsentimiento()
    {
        $datos = json_decode(file_get_contents('php://input'), true);

        $resultado = $this->usuario_servicio->registrarConsentimiento($datos);

        echo json_encode($resultado);
    }
}