<?php

class NegocioModelo extends Modelo {
    public function __construct($conexion)
    {
        parent::__construct($conexion);
    }

    public function registrarEntidad($datos)
    {
        $sql = "INSERT INTO entidades (nombre, email, telefono)
                VALUES (:nombre, :email, :telefono)";

        $parametros = [
            ':nombre' => $datos['nombre'],
            ':email' => $datos['email'],
            ':telefono' => $datos['telefono']
        ];

        return $this->ejecutar($sql, $parametros);
    }

    public function registrarNegocio($id_negocio)
    {
        $sql = "INSERT INTO negocios (id) VALUES (:id)";

        $parametros = [
            ':id' => $id_negocio
        ];

        return $this->ejecutar($sql, $parametros);
    }
}