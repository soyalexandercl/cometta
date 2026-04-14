<?php

require __DIR__ . '/../vendor/autoload.php';

use Nucleo\Enrutador;

$enrutador = new Enrutador();

$archivos = glob(__DIR__ . '/../api/rutas/*.php');

foreach ($archivos as $archivo) {
    require $archivo;
}

$enrutador->procesarRutas();