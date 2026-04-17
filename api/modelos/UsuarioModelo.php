<?php

class UsuarioModelo extends Modelo {
    public function __construct($conexion)
    {
        parent::__construct($conexion);
    }

    public function obtenerConsentimiento($rol)
    {
        $sql = "SELECT *
                FROM consentimientos
                WHERE rol = :rol
                ORDER BY id DESC
                LIMIT 1";

        $parametros = [':rol' => $rol];

        return $this->obtenerUno($sql, $parametros);
    }

    public function registrarConsentimiento($id_usuario, $id_consentimiento)
    {
        $sql = "INSERT INTO usuarios_consentimientos (id_usuario, id_consentimiento)
                VALUES (:id_usuario, :id_consentimiento)";

        $parametros = [
            ':id_usuario' => $id_usuario,
            ':id_consentimiento' => $id_consentimiento
        ];

        return $this->ejecutar($sql, $parametros);
    }
}