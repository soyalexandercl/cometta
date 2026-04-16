<?php

namespace Servicios;

use Firebase\JWT\JWT;
use Modelos\AuthModelo;

class AuthServicio
{
    private $conexion;
    private $auth_modelo;
    private $clave;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
        $this->auth_modelo = new AuthModelo($conexion);
        $this->clave = '"TU_CLAVE_SECRETA_SUPER_SEGURA"';

        var_dump($conexion);
    }

    public function autenticar($datos)
    {
        // Lógica para autenticar a un usuario
        $usuario = $this->auth_modelo->obtenerEmail($datos['email']);
        
        if (!$usuario || !password_verify($datos['contrasena'], $usuario['contrasena'])) {
            return ['success' => false, 'message' => 'Credenciales incorrectas'];
        }

        $payload = [
            'iss' => 'cometta_api', // Emisor
            'iat' => time(), // Tiempo de emisión
            'exp' => time() + (60 * 60), // Expira en 1 hora
            'sub' => $usuario['id'], // ID del usuario
        ];

        $jwt = JWT::encode($payload, $this->clave, 'HS256');

        return [
            'success' => true,
            'token' => $jwt
        ];
    }
}