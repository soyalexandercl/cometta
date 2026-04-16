<?php

class AuthModelo extends Modelo
{
    public function __construct($conexion)
    {
        parent::__construct($conexion);
    }

    public function registrarUsuario($datos)
    {
        $sql = "INSERT INTO usuarios (nombre, apellidos, email, telefono, contrasena)
                VALUES (:nombre, :email, :contrasena)";

        $parametros = [
            ':nombre' => $datos['nombre'],
            ':apellidos' => $datos['apellidos'],
            ':email' => $datos['email'],
            ':telefono' => $datos['telefono'],
            ':contrasena' => password_hash($datos['contrasena'], PASSWORD_BCRYPT)
        ];

        return $this->ejecutar($sql, $parametros);
    }

    public function registrarRol($id_usuario, $rol) {
        $sql = "INSERT INTO usuarios_roles (id_usuario, rol) VALUES (:id_usuario, :rol)";

        $parametros = [
            ':id_usuario' => $id_usuario,
            ':rol' => $rol
        ];

        return $this->ejecutar($sql, $parametros);
    }

    public function obtenerRol($id_usuario, $rol) {
        $sql = "SELECT * FROM usuarios_roles WHERE id_usuario = :id_usuario AND rol = :rol";

        $parametros = [
            ':id_usuario' => $id_usuario,
            ':rol' => $rol
        ];

        return $this->obtenerUno($sql, $parametros);
    }

    public function registrarUsuarioNegocio($id_usuario, $id_negocio) {
        $sql = "INSERT INTO usuarios_negocios (id_usuario, id_negocio) VALUES (:id_usuario, :id_negocio)";

        $parametros = [
            ':id_usuario' => $id_usuario,
            ':id_negocio' => $id_negocio
        ];

        return $this->ejecutar($sql, $parametros);
    }

    public function obtenerEmail($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email";

        $parametros = [':email' => $email];

        return $this->obtenerUno($sql, $parametros);
    }

    public function obtenerTelefono($telefono)
    {
        $sql = "SELECT * FROM usuarios WHERE telefono = :telefono";

        $parametros = [':telefono' => $telefono];

        return $this->obtenerUno($sql, $parametros);
    }
}