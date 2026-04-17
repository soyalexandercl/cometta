<?php

use Controladores\UsuarioControlador;

$enrutador->setEntidad('/usuario');

$enrutador->agregarRuta('GET', '/consent', UsuarioControlador::class, 'obtenerConsentimiento');
$enrutador->agregarRuta('POST', '/consents', UsuarioControlador::class, 'registrarConsentimiento');