<?php

namespace nucleo;

class Enrutador {

    private $rutas = [];

    public function add($metodo, $ruta, $proceso) {
        $this->rutas[] = [
            'metodo' => $metodo,
            'ruta' => $ruta,
            'proceso' => $proceso
        ];
    }

    public function procesar() {

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $metodo = $_SERVER['REQUEST_METHOD'];

        foreach ($this->rutas as $ruta) {

            if ($ruta['metodo'] === $metodo && $ruta['ruta'] === $uri) {
                return call_user_func($ruta['proceso']);
            }
        }

        http_response_code(404);

        $respuesta = [
            'success' => false,
            'message' => 'Ruta no encontrada'
        ];

        echo json_encode($respuesta);
    }
}