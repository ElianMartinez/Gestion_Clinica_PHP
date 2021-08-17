<?php

require_once "ConexionBD.php";

class PacientesM extends ConexionBD
{

    //Crear Pacientes_temp
    public static function CrearPacienteM($tablaBD, $datosC)
    {

        $pdo = ConexionBD::cBD()->prepare("INSERT INTO $tablaBD(apellido, nombre, documento, correo,usuario, clave, rol) VALUES (:apellido, :nombre, :documento, :correo,:usuario, :clave, :rol)");
        $pdo->bindParam(":apellido", $datosC["apellido"], PDO::PARAM_STR);
        $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam(":documento", $datosC["documento"], PDO::PARAM_STR);
        $pdo->bindParam(":correo", $datosC["correo"], PDO::PARAM_STR);
        $pdo->bindParam(":usuario", $datosC["usuario"], PDO::PARAM_STR);
        $pdo->bindParam(":clave", $datosC["clave"], PDO::PARAM_STR);
        $pdo->bindParam(":rol", $datosC["rol"], PDO::PARAM_STR);
        if ($pdo->execute()) {
            return true;
        }
        $pdo->close();
        $pdo = null;
    }

    //Crear Pacientes
    public static function CrearPacienteTempM($datosC)
    {

        $pdo = ConexionBD::cBD()->prepare("INSERT INTO `paciente_temp`(`apellido`, `nombre`, `documento`,`correo`,`usuario`, `clave`, `verificode`) VALUES (:apellido, :nombre, :documento, :correo,:usuario, :clave, :code)");
        $pdo->bindParam(":apellido", $datosC["apellido"], PDO::PARAM_STR);
        $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam(":documento", $datosC["documento"], PDO::PARAM_STR);
        $pdo->bindParam(":usuario", $datosC["usuario"], PDO::PARAM_STR);
        $pdo->bindParam(":clave", $datosC["clave"], PDO::PARAM_STR);
        $pdo->bindParam(":code", $datosC["code"], PDO::PARAM_STR);
        if ($pdo->execute()) {
            return true;
        }
        $pdo->close();
        $pdo = null;
    }

    //Ver Pacientes
    public static function VerPacientesM($tablaBD, $columna, $valor)
    {

        if ($columna == null) {

            $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD ORDER BY apellido ASC");

            $pdo->execute();

            return $pdo->fetchAll();

        } else {

            $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE $columna = :$columna ORDER BY apellido ASC");

            $pdo->bindParam(":" . $columna, $valor, PDO::PARAM_STR);

            $pdo->execute();

            return $pdo->fetch();

        }

        $pdo->close();
        $pdo = null;

    }

    //Borrar Paciente
    public static function BorrarPacienteM($tablaBD, $id)
    {

        $pdo = ConexionBD::cBD()->prepare("DELETE FROM $tablaBD WHERE id = :id");

        $pdo->bindParam(":id", $id, PDO::PARAM_INT);

        if ($pdo->execute()) {
            return true;
        }

        $pdo->close();
        $pdo = null;

    }

    //Actualizar Paciente
    public static function ActualizarPacienteM($tablaBD, $datosC)
    {

        $pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET apellido = :apellido, nombre = :nombre, documento = :documento, usuario = :usuario, correo = :correo, clave = :clave WHERE id = :id");

        $pdo->bindParam("id", $datosC["id"], PDO::PARAM_INT);
        $pdo->bindParam("apellido", $datosC["apellido"], PDO::PARAM_STR);
        $pdo->bindParam("nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam("documento", $datosC["documento"], PDO::PARAM_STR);
        $pdo->bindParam("correo", $datosC["correo"], PDO::PARAM_STR);
        $pdo->bindParam("usuario", $datosC["usuario"], PDO::PARAM_STR);
        $pdo->bindParam("clave", $datosC["clave"], PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        }

        $pdo->close();
        $pdo = null;

    }

    //Ingreso de los Pacientes
    public static function IngresarPacienteM($tablaBD, $datosC)
    {

        $pdo = ConexionBD::cBD()->prepare("SELECT usuario, clave, apellido, nombre, documento, foto, rol, id FROM $tablaBD WHERE usuario = :usuario");
        $pdo->bindParam(":usuario", $datosC["usuario"], PDO::PARAM_STR);
        $pdo->execute();
        return $pdo->fetch();
        $pdo->close();
        $pdo = null;

    }

    //Ver Perfil del Paciente
    public static function VerPerfilPacienteM($tablaBD, $id)
    {

        $pdo = ConexionBD::cBD()->prepare("SELECT usuario, clave, apellido, correo, nombre, documento, foto, rol, id FROM $tablaBD WHERE id = :id");

        $pdo->bindParam(":id", $id, PDO::PARAM_INT);

        $pdo->execute();

        return $pdo->fetch();

        $pdo->close();
        $pdo = null;

    }

    //Actualizar perfil del Paciente
    public static function ActualizarPerfilPacienteM($tablaBD, $datosC)
    {

        $pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET usuario = :usuario, clave = :clave, nombre = :nombre, apellido = :apellido, documento = :documento, correo = :correo, foto = :foto WHERE id = :id");

        $pdo->bindParam(":id", $datosC["id"], PDO::PARAM_INT);
        $pdo->bindParam(":usuario", $datosC["usuario"], PDO::PARAM_STR);
        $pdo->bindParam(":clave", $datosC["clave"], PDO::PARAM_STR);
        $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam(":apellido", $datosC["apellido"], PDO::PARAM_STR);
        $pdo->bindParam(":documento", $datosC["documento"], PDO::PARAM_STR);
        $pdo->bindParam(":correo", $datosC["correo"], PDO::PARAM_STR);
        $pdo->bindParam(":foto", $datosC["foto"], PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        }

        $pdo->close();
        $pdo = null;

    }

}
