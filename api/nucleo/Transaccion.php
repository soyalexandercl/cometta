<?php

namespace Nucleo;

class Transaccion
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function begin()
    {
        $this->conexion->beginTransaction();
    }

    public function commit()
    {
        $this->conexion->commit();
    }

    public function rollback()
    {
        if ($this->conexion->inTransaction()) {
            $this->conexion->rollBack();
        }
    }
}
