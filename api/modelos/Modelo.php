<?php

namespace Modelos;

use PDO;

class Modelo
{
    protected $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerTodos($sql, $parametros = [])
    {
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute($parametros);

        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUno($sql, $parametros = [])
    {
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute($parametros);

        return $sentencia->fetch(PDO::FETCH_ASSOC);
    }

    public function ejecutar($sql, $parametros = [])
    {
        $sentencia = $this->conexion->prepare($sql);

        return $sentencia->execute($parametros);
    }

    public function obtenerId()
    {
        return $this->conexion->lastInsertId();
    }
}
