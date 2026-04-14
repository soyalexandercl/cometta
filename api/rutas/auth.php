<?php

use Controladores\AuthControlador;

$enrutador->setEntidad('/auth');

$enrutador->agregarRuta('POST', '/registro', AuthControlador::class, 'registro');
$enrutador->agregarRuta('POST', '/login', AuthControlador::class, 'login');