<?php
require_once("../config/conexion.php");
class Usuario extends Conectar {
    public function login($email, $password) {
        $conectar = parent::getConexion();
        parent::set_names();
        try {
            $sql = "SELECT * FROM usuarios WHERE usu_correo = :email";
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($password === $usuario["usu_pass"]) { 
                    session_start();
                    $_SESSION["usu_id"] = $usuario["id"];
                    $_SESSION["usu_nom"] = $usuario["nombre"];
                    $_SESSION["usu_correo"] = $usuario["usu_correo"];
                    return true;
                } else {
                    echo "Contraseña incorrecta.";
                }
            } else {
                echo "Correo no encontrado.";
            }
            return false;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}