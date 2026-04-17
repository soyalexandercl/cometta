<?php

namespace Servicios;

use Firebase\JWT\JWT;
use Modelos\AuthModelo;

class AuthServicio
{
    private $conexion;
    private $auth_modelo;
    private $clave_secreta;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
        $this->auth_modelo = new AuthModelo($conexion);
        $this->clave_secreta = $_ENV['JWT_CLAVE_SECRETA'];
    }

    public function iniciarSesion($datos)
    {
        // Estructura
        // "email": "alexcardonal24@gmail.com",
        // "contrasena": "12345678",
        // "rol": "negocio"

        $obtener_usuario = $this->auth_modelo->obtenerEmail($datos['email']);

        if (!$obtener_usuario || !password_verify($datos['contrasena'], $obtener_usuario['contrasena'])) {
            
        }

        $obtener_rol = $this->auth_modelo->obtenerRol($obtener_usuario['id'], $datos['rol']);

        if (!$obtener_rol) {
            $registrar_rol = $this->auth_modelo->registrarRol($obtener_usuario['id'], $datos['rol']);
        }

        $payload = [
            'iss' => 'cometta_api',
            'iat' => time(),
            'exp' => time() + (60 * 60),
            'sub' => $obtener_usuario['id'],
            'rol' => $datos['rol']
        ];

        $jwt = JWT::encode($payload, $this->clave_secreta, 'HS256');

        $parametros_respuesta = [
            'success' => true,
            'token' => $jwt
        ];

        return $parametros_respuesta;
    }

    public function registrarUsuario($datos)
    {
        // Estructura
        // "nombre": "Alex",
        // "apellidos": "Cardona",
        // "email": "alexcardonal24@gmail.com",
        // "telefono": "1234567890",
        // "contrasena": "12345678",
        // "fecha_nacimiento": "1990-01-01",
        // "rol": "negocio"

        $obtener_email = $this->auth_modelo->obtenerEmail($datos['email']);   
        
        if ($obtener_email) {
            
        }

        $obtener_telefono = $this->auth_modelo->obtenerTelefono($datos['telefono']);

        if ($obtener_telefono) {
            
        }

        $registrar_usuario = $this->auth_modelo->registrarUsuario($datos);

        $id_usuario = $this->auth_modelo->obtenerId();

        $registrar_rol = $this->auth_modelo->registrarRol($id_usuario, $datos['rol']);

        $payload = [
            'iss' => 'cometta_api',
            'iat' => time(),
            'exp' => time() + (60 * 60),
            'sub' => $id_usuario,
            'rol' => $datos['rol']
        ];

        $jwt = JWT::encode($payload, $this->clave_secreta, 'HS256');

        $parametros_respuesta = [
            'success' => true,
            'token' => $jwt
        ];

        return $parametros_respuesta;
    }
}