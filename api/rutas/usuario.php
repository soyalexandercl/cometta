<?php

use Controladores\UsuarioControlador;

$enrutador->setEntidad('/user');

$enrutador->agregarRuta('GET', '/consent', UsuarioControlador::class, 'obtenerConsentimiento');
$enrutador->agregarRuta('POST', '/consents', UsuarioControlador::class, 'registrarConsentimiento');