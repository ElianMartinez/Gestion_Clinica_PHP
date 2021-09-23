<?php

require_once "ConexionBD.php";

class HistorialSecretariaM extends ConexionBD
{
//Borrar Secretarias

    public static function BorrarHistoriaSecretariaM($tablaBD, $id)
    {

        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM citas WHERE id = :id");
        $pdo->bindParam(":id", $id, PDO::PARAM_INT);
        $pdo->execute();
        $res = $pdo->fetch();

        $idCon = $res['id_consultorio'];

        $pdo22 = ConexionBD::cBD()->prepare("SELECT * FROM pacientes WHERE id = :id");
        $pdo22->bindParam(":id", $res["id_paciente"], PDO::PARAM_INT);
        $pdo22->execute();
        $res22 = $pdo22->fetch();

        $pdo883 = ConexionBD::cBD()->prepare("SELECT * FROM doctores WHERE id = :id");
        $pdo883->bindParam(":id", $res["id_doctor"], PDO::PARAM_INT);
        $pdo883->execute();
        $res33 = $pdo883->fetch();
        $idD = $res33["id"];
        $msg = 'El paciente ' . $res22["nombre"] . ' ' . $res22["apellido"] . ' ID:' . $res["id_paciente"] . ' ha cancelado la cita del ' . $res["fechaC"] . ' : ' . $res["tiempoa"];
        $msg1 = ' Del doctor/a ' . $res33["nombre"] . ' ' . $res33["apellido"];
        $msg2 = 'Se ha cancelado la cita del ' . $res["fechaC"] . ' : ' . $res["tiempoa"] . $msg1;
        $mstotal = $msg . $msg1;

        
$pdo2 = ConexionBD::cBD()->prepare("INSERT INTO notificaciones (id_usuario, tabla, mensaje) VALUES (:idp,'Paciente',:msg )");
$pdo2->bindParam(":idp", $res["id_paciente"], PDO::PARAM_INT);
$pdo2->bindParam(":msg", $msg2, PDO::PARAM_STR);
$pdo2->execute();

        $pdo88 = ConexionBD::cBD()->prepare("INSERT INTO `notificaciones` (`id_usuario`, `mensaje`, `leido`, `tabla`) values (:idA, :messa, 0, 'Doctor')");
        $pdo88->bindParam(":idA", $idD, PDO::PARAM_INT);
        $pdo88->bindParam(":messa", $msg2, PDO::PARAM_STR);
        $pdo88->execute();

        $pdo2 = ConexionBD::cBD()->prepare("INSERT INTO `notificaciones` (`id_usuario`, `mensaje`, `leido`, `tabla`) SELECT  `id`, :messag, 0, 'Secretaria' FROM  `secretarias` WHERE id_consultorio = :idcon");
        $pdo2->bindParam(":messag", $msg2, PDO::PARAM_STR);
        $pdo2->bindParam(":idcon", $idCon, PDO::PARAM_INT);
        $pdo2->execute();

        $pdo = ConexionBD::cBD()->prepare("DELETE FROM $tablaBD WHERE id = :id");
        $pdo->bindParam(":id", $id, PDO::PARAM_INT);
        if ($pdo->execute()) {

            return true;
        } else {
            return false;
        }
        $pdo->close();
        $pdo = null;


    }
}

