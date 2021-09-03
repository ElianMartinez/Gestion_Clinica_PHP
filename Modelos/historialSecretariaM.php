<?php

require_once "ConexionBD.php";

class HistorialSecretariaM extends ConexionBD
{
//Borrar Secretarias

    public static function BorrarHistoriaSecretariaM($tablaBD, $id)
    {

        $pdo1 = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE id = :id");
        $pdo1->bindParam(":id", $id, PDO::PARAM_INT);
        $pdo1->execute();
        $res = $pdo1->fetch();

        $idP = $res["id_paciente"];
        $msg = "Se ha cancelado la cita del " . $res["inicio"];

        $pdo2 = ConexionBD::cBD()->prepare("INSERT INTO notificaciones (id_usuario, tabla, mensaje) VALUES (:idp,'Paciente',:msg )");
        $pdo2->bindParam(":idp", $idP, PDO::PARAM_INT);
        $pdo2->bindParam(":msg", $msg, PDO::PARAM_STR);
        $pdo2->execute();

        $pdo = ConexionBD::cBD()->prepare("DELETE FROM $tablaBD WHERE id = :id");
        $pdo->bindParam(":id", $id, PDO::PARAM_INT);
        if ($pdo->execute()) {

            return true;

        } else {
            return false;
        }

    }
}
