<?php

namespace Servicios;

use Modelos\UsuarioModelo;

class UsuarioServicio
{
    private $conexion;
    private $usuario_modelo;
    private $clave_secreta;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
        $this->usuario_modelo = new UsuarioModelo($conexion);
    }

    public function obtenerConsentimiento($rol) {
        // Estructura
        // "rol": "negocio"

        return $this->usuario_modelo->obtenerConsentimiento($rol);
    }

    public function registrarConsentimiento($datos) {
        // Estructura
        // "id_usuario": 1,
        // "id_consentimiento": 1

        return $this->usuario_modelo->registrarConsentimiento($datos);
    }
}