<?php

class AuthModelo extends Modelo
{
    public function registrar($nombre, $email, $contrasena)
    {
        $sql = "INSERT INTO usuarios (nombre, email, contrasena)
                VALUES (:nombre, :email, :contrasena)";

        $parametros = [
            ':nombre' => $nombre,
            ':email' => $email,
            ':contrasena' => password_hash($contrasena, PASSWORD_BCRYPT)
        ];

        return $this->ejecutar($sql, $parametros);
    }

    public function obtenerEmail($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email";

        $parametros = [':email' => $email];

        return $this->obtenerUno($sql, $parametros);
    }
}