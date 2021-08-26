<?php

require_once "ConexionBD.php";

class historialM extends ConexionBD
{
//Borrar Secretarias

    public static function BorrarHistoriaM($tablaBD, $id)
    {
        if ($id > 100) {

            $pdo = ConexionBD::cBD()->prepare("SELECT * FROM citas WHERE id = :id");
            $pdo->bindParam(":id", $id, PDO::PARAM_INT);
            $pdo->execute();
            $res = $pdo->fetch();

            $pdo22 = ConexionBD::cBD()->prepare("SELECT * FROM pacientes WHERE id = :id");
            $pdo22->bindParam(":id", $res["id_paciente"], PDO::PARAM_INT);
            $pdo22->execute();
            $res22 = $pdo22->fetch();

            $pdo883 = ConexionBD::cBD()->prepare("SELECT * FROM doctores WHERE id = :id");
            $pdo883->bindParam(":id", $res["id_doctor"], PDO::PARAM_INT);
            $pdo883->execute();
            $res33 = $pdo883->fetch();
            $idD = $res33["id"];
            $msg = 'El paciente ' . $res22["nombre"] . ' ' . $res22["apellido"] . ' ' . $res["id_paciente"] . ' ha cancelado la cita del ' . $res["fechaC"] . ' : ' . $res["tiempoa"];
            $msg1 = ' Del doctor ' . $res33["nombre"] . ' ' . $res33["apellido"];
            $mstotal = $msg . $msg1;
            $pdo88 = ConexionBD::cBD()->prepare("INSERT INTO `notificaciones` (`id_usuario`, `mensaje`, `leido`, `tabla`) values (:id_A, :messa, 0, 'Doctor')");
            $pdo88->bindParam(":messag", $mstotal, PDO::PARAM_STR);
            $pdo88->bindParam(":id_A", $idD, PDO::PARAM_INT);
            $pdo88->execute();

            $pdo2 = ConexionBD::cBD()->prepare("INSERT INTO `notificaciones` (`id_usuario`, `mensaje`, `leido`, `tabla`) SELECT  `id`, :messag, 0, 'Secretaria' FROM  `secretarias` ");
            $pdo2->bindParam(":messag", $mstotal, PDO::PARAM_STR);
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
        } else {
            return false;
        }

    }

}
