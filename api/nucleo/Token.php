<?php

namespace Nucleo;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Token
{
    public function generarToken($id_usuario, $rol)
    {
        $clave_secreta = $_ENV['JWT_CLAVE_SECRETA'];
        
        $payload = [
            'iss' => 'cometta_api',
            'iat' => time(),
            'exp' => time() + (60 * 60),
            'sub' => $id_usuario,
            'rol' => $rol
        ];

        return JWT::encode($payload, $clave_secreta, 'HS256');
    }

    public function comprobarToken()
    {
        $headers = getallheaders();
        $authorization = $headers['authorization'];
        
        $token = str_replace('Bearer ', '', $authorization);

        $clave_secreta = $_ENV['JWT_CLAVE_SECRETA'];

        return JWT::decode($token, new Key($clave_secreta, 'HS256'));
    }
}