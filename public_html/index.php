<?php

require __DIR__ . '/../vendor/autoload.php';

use Api\Nucleo\Enrutador;

$enrutador = new Enrutador();

// require __DIR__ . '/../api/routes/api_v1.php';

$enrutador->procesar();