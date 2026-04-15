<?php

namespace Nucleo;

use PDO;
use PDOException;

class Conexion
{
    private PDO $conexion;

    public function __construct()
    {
        $this->construiirConexion();
        $this->obtenerConexion();
    }

    public function construiirConexion()
    {
        $host = $_ENV['BASEDATOS_HOST'];
        $nombre = $_ENV['BASEDATOS_NOMBRE'];
        $usuario = $_ENV['BASEDATOS_USUARIO'];
        $password = $_ENV['BASEDATOS_PASSWORD'];

        $dsn = "mysql:host=$host;dbname=$nombre;charset=utf8";

        try {
            $opciones = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];

            $this->conexion = new PDO($dsn, $usuario, $password, $opciones);

            // Eliminar en producción y configurar el timezone en UTC para evitar problemas de fechas
            $this->conexion->exec("SET time_zone = '+00:00'");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function obtenerConexion()
    {
        return $this->conexion;
    }
}