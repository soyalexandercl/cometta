<?php

require __DIR__ . '/../vendor/autoload.php';

$env = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$env->load();

use Nucleo\Enrutador;

$enrutador = new Enrutador();

$archivos = glob(__DIR__ . '/../rutas/*.php');

foreach ($archivos as $archivo) {
    require $archivo;
}

$enrutador->procesarRutas();