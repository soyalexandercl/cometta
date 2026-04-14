<?php

namespace Controladores;

class AuthControlador {

    public function login() {
        $respuesta = [
            'success' => true,
            'message' => 'Login exitoso',
            'data' => [
                'token' => 'ejemplo_de_token_12345'
            ]
        ];

        echo json_encode($respuesta);
    }

    public function registro() {
        http_response_code(201);

        $respuesta = [
            'success' => true,
            'message' => 'Usuario registrado correctamente'
        ];

        echo json_encode($respuesta);
    }

    public function perfil() {
        $respuesta = [
            'success' => true,
            'message' => 'Datos del perfil',
            'data' => [
                'id' => 1,
                'nombre' => 'Alexander',
                'rol' => 'Admin'
            ]
        ];

        echo json_encode($respuesta);
    }
}