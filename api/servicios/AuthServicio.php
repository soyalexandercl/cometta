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
        // $obtener_usuario = $this->auth_modelo->obtenerEmail($datos['email']);
        
        // if (!$obtener_usuario || !password_verify($datos['contrasena'], $obtener_usuario['contrasena'])) {
            
        // }

        // $obtener_rol = $this->auth_modelo->obtenerRol($obtener_usuario['id'], $datos['app']);

        // if (!$obtener_rol) {
        //     $registrar_rol = $this->auth_modelo->registrarRol($obtener_usuario['id'], $datos['app']);
        // }

        // $payload = [
        //     'iss' => 'cometta_api',
        //     'iat' => time(),
        //     'exp' => time() + (60 * 60),
        //     'sub' => $obtener_usuario['id'],
        //     'app' => $datos['app']
        // ];

        // $jwt = JWT::encode($payload, $this->clave_secreta, 'HS256');

        return $datos;
    }

    public function registrarUsuario($datos)
    {

        // return $datos;

        // $obtener_email = $this->auth_modelo->obtenerEmail($datos['email']);   
        
        // if ($obtener_email) {
            
        // }

        // $obtener_telefono = $this->auth_modelo->obtenerTelefono($datos['telefono']);

        // if ($obtener_telefono) {
            
        // }

        // $registrar_usuario = $this->auth_modelo->registrarUsuario($datos);

        // $id_usuario = $this->auth_modelo->obtenerId();

        // $registrar_rol = $this->auth_modelo->registrarRol($id_usuario, $datos['app']);

        // $payload = [
        //     'iss' => 'cometta_api',
        //     'iat' => time(),
        //     'exp' => time() + (60 * 60),
        //     'sub' => $id_usuario,
        //     'app' => $datos['app']
        // ];
    }
}