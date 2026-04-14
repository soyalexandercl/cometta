<?php

use Controladores\AuthControlador;

$enrutador->setEntidad('/auth');

$enrutador->agregarRuta('POST', '/login', AuthControlador::class, 'login');