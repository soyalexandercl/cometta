<?php

use Controladores\AuthControlador;

$enrutador->setEntidad('/auth');

$enrutador->agregarRuta('POST', '/login', AuthControlador::class, 'iniciarSesion');
$enrutador->agregarRuta('POST', '/register', AuthControlador::class, 'registrarUsuario');