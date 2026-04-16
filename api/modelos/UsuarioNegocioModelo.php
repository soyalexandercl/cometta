<?php

class UsuarioNegocioModelo extends Modelo
{
    public function __construct($conexion)
    {
        parent::__construct($conexion);
    }

    function obtenerUsuario($id_usuario) {
        $sql = "SELECT usuarios.id
                FROM usuario_negocios
                JOIN usuarios_roles ON usuarios_roles.id_usuario = usuario_negocios.id_usuario
                    AND usuarios_roles.rol = 'negocio'
                JOIN usuarios ON usuarios.id = usuarios_roles.id_usuario
                WHERE usuario_negocios.id_usuario = :id_usuario";

        $parametros = [':id_usuario' => $id_usuario];

        return $this->obtenerUno($sql, $parametros);
    }
}