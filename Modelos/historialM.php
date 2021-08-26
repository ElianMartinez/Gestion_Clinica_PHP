<?php

require_once "ConexionBD.php";

class historialM extends ConexionBD
{
//Borrar Secretarias

    public static function BorrarHistoriaM($tablaBD, $id)
    {
        $pd1o = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE id = :id");
        $pd1o->bindParam(":id", $id, PDO::PARAM_INT);
        $pd1o->execute();
        $kk = $pd1o->fetch();
        if (isset($kk)) {
            $pdo = ConexionBD::cBD()->prepare("DELETE FROM $tablaBD WHERE id = :id");
            $pdo->bindParam(":id", $id, PDO::PARAM_INT);
            if ($pdo->execute()) {
                $pdo = ConexionBD::cBD()->prepare("SELECT * FROM citas WHERE id = :id");
                $pdo->bindParam(":id", $id, PDO::PARAM_INT);
                $pdo->execute();
                $res = $pdo->fetch();

                $pdo22 = ConexionBD::cBD()->prepare("SELECT * FROM pacientes WHERE id = :id");
                $pdo22->bindParam(":id", $res["id_paciente"], PDO::PARAM_INT);
                $pdo22->execute();
                $res22 = $pdo22->fetch();

                $pdo33 = ConexionBD::cBD()->prepare("SELECT * FROM doctores WHERE id = :id");
                $pdo33->bindParam(":id", $res["id_doctor"], PDO::PARAM_INT);
                $pdo33->execute();
                $res33 = $pdo33->fetch();

                $msg = 'El paciente ' . $res22["nombre"] . ' ' . $res22["apellido"] . ' ' . $res["id_paciente"] . ' ha cancelado la cita del ' . $res["fechaC"] . ' : ' . $res["tiempoa"];
                $msg1 = ' Del doctor ' . $res33["nombre"] . ' ' . $res33["apellido"];
                $mstotal = $msg . $msg1;
                $pdo3 = ConexionBD::cBD()->prepare("INSERT INTO `notificaciones` (`id_usuario`, `mensaje`, `leido`, `tabla`) values (:id, :messa, 0, 'Doctor') ");
                $pdo3->bindParam(":messag", $msg, PDO::PARAM_STR);
                $pdo3->bindParam(":id", $res33["id"], PDO::PARAM_STR);
                $pdo3->execute();

                $pdo2 = ConexionBD::cBD()->prepare("INSERT INTO `notificaciones` (`id_usuario`, `mensaje`, `leido`, `tabla`) SELECT  `id`, :messag, 0, 'Secretaria' FROM  `secretarias` ");
                $pdo2->bindParam(":messag", $mstotal, PDO::PARAM_STR);
                if ($pdo2->execute()) {
                    return true;
                }
            } else {
                return false;
            }
            $pdo->close();
            $pdo = null;
        }
    }

}
