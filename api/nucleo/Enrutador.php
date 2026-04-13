<?php

namespace Api\Nucleo;

class Enrutador {

    private $rutas = [];
    private $entidad;

    public function setEntidad($entidad) {
        $this->entidad = $entidad;
    }

    public function agregarRuta($metodo_http, $ruta, $clase, $metodo_clase) {
        $this->rutas[] = [
            'metodo_http' => $metodo_http,
            'ruta' => $this->entidad . $ruta,
            'clase' => $clase,
            'metodo_clase' => $metodo_clase
        ];
    }

    public function procesarRuta() {

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