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
        $metodo_http = $_SERVER['REQUEST_METHOD'];

        foreach ($this->rutas as $ruta) {

            if ($ruta['metodo_http'] === $metodo_http && $ruta['ruta'] === $uri) {
                $clase = $ruta['clase'];
                $metodo_clase = $ruta['metodo_clase'];

                if (class_exists($clase)) {
                    $controlador = new $clase();

                    return $controlador->$metodo_clase();
                } else {

                    http_response_code(500);

                    $respuesta = [
                        'success' => false,
                        'message' => 'Controlador no encontrado'
                    ];
                    
                     echo json_encode($respuesta);
                     return;
                }
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