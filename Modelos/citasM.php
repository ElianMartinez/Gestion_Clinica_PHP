<?php

require_once "ConexionBD.php";

class CitasM extends ConexionBD
{

    //Pedir Cita Paciente
    public static function EnviarCitaM($tablaBD, $datosC)
    {

        $pdo = ConexionBD::cBD()->prepare("INSERT INTO $tablaBD (id_doctor, id_consultorio, id_paciente, nyaP, documento, inicio, fin, tiempoa, tiempob, fechaC, metodoP) VALUES (:id_doctor, :id_consultorio, :id_paciente, :nyaP, :documento, :inicio, :fin, :tiempoa, :tiempob, :fechaC, :mpa)");

        $pdo->bindParam(":id_doctor", $datosC["Did"], PDO::PARAM_INT);
        $pdo->bindParam(":id_consultorio", $datosC["Cid"], PDO::PARAM_INT);
        $pdo->bindParam(":id_paciente", $datosC["Pid"], PDO::PARAM_INT);
        $pdo->bindParam(":nyaP", $datosC["nyaC"], PDO::PARAM_STR);
        $pdo->bindParam(":documento", $datosC["documentoC"], PDO::PARAM_STR);
        $pdo->bindParam(":inicio", $datosC["fyhIC"], PDO::PARAM_STR);
        $pdo->bindParam(":fin", $datosC["fyhFC"], PDO::PARAM_STR);
        $pdo->bindParam(":tiempoa", $datosC["fyhIA"], PDO::PARAM_STR);
        $pdo->bindParam(":tiempob", $datosC["fyhFB"], PDO::PARAM_STR);
        $pdo->bindParam(":fechaC", $datosC["fechaz"], PDO::PARAM_STR);
        $pdo->bindParam(":mpa", $datosC["mpago"], PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        }

        $pdo->close();
        $pdo = null;

    }

    public static function UpdateHous($datosC)
    {
        $pdo = ConexionBD::cBD()->prepare("UPDATE citas set inicio = :inicio, fin = :fin, tiempoa = :tiempoa, tiempob =:tiempob where id =:id");
        $pdo->bindParam(":id", $datosC["idCita"], PDO::PARAM_STR);
        $pdo->bindParam(":inicio", $datosC["fechaI"], PDO::PARAM_STR);
        $pdo->bindParam(":fin", $datosC["fechaF"], PDO::PARAM_STR);
        $pdo->bindParam(":tiempoa", $datosC["fechaI"], PDO::PARAM_STR);
        $pdo->bindParam(":tiempob", $datosC["fechaF"], PDO::PARAM_STR);
        $pdo->execute();

        $tabla = "Paciente";
        $pdo1 = ConexionBD::cBD()->prepare("INSERT INTO notificaciones (id_usuario, tabla, mensaje) VALUES (:idp, :tabl, :mess)");
        $pdo1->bindParam(":idp", $datosC["idPa"], PDO::PARAM_INT);
        $pdo1->bindParam(":tabl", $tabla, PDO::PARAM_STR);
        $pdo1->bindParam(":mess", $datosC["message"], PDO::PARAM_STR);
        if ($pdo1->execute()) {
            return true;
        } else {
            return false;
        }

    }

    //Mostrar Citas
    public static function VerCitasM($tablaBD)
    {
        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD");
        $pdo->execute();
        return $pdo->fetchAll();
        $pdo->close();
        $pdo = null;

    }

    public static function VerCitasPaM($tablaBD, $id)
    {
        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD where id_paciente = $id");
        $pdo->execute();
        return $pdo->fetchAll();
        $pdo->close();
        $pdo = null;

    }

    public static function VerCitasidM($tablaBD, $id)
    {
        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD where id_consultorio = $id");
        $pdo->execute();
        return $pdo->fetchAll();
        $pdo->close();
        $pdo = null;

    }

    public static function Pagar($id)
    {
        $pdo = ConexionBD::cBD()->prepare("UPDATE citas SET pago = 1 where id = :id");
        $pdo->bindParam(":id", $id, PDO::PARAM_INT);
        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }

        $pdo->close();
        $pdo = null;
    }

    //Pedir Cita como Doctor
    public static function PedirCitaDoctorM($tablaBD, $datosC)
    {

        $pdo = ConexionBD::cBD()->prepare("INSERT INTO $tablaBD (id_doctor, id_consultorio, nyaP, documento, inicio, fin, id_paciente, tiempoa, tiempob,fechaC, metodoP) VALUES (:id_doctor, :id_consultorio, :nyaP, :documento, :inicio, :fin, :idP,:inicio,:fin,:fin,:mpa )");

        $pdo->bindParam(":id_doctor", $datosC["Did"], PDO::PARAM_INT);
        $pdo->bindParam(":id_consultorio", $datosC["Cid"], PDO::PARAM_INT);
        $pdo->bindParam(":nyaP", $datosC["nombreP"], PDO::PARAM_STR);
        $pdo->bindParam(":documento", $datosC["documentoP"], PDO::PARAM_STR);
        $pdo->bindParam(":inicio", $datosC["fyhIC"], PDO::PARAM_STR);
        $pdo->bindParam(":fin", $datosC["fyhFC"], PDO::PARAM_STR);
        $pdo->bindParam(":idP", $datosC["pID"], PDO::PARAM_INT);
        $pdo->bindParam(":mpa", $datosC["mpago"], PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        }

        $pdo->close();
        $pdo = null;

    }

    //Pedir Cita como Doctor
    public static function PedirCitaSecretariaM($tablaBD, $datosC)
    {

        $pdo = ConexionBD::cBD()->prepare("INSERT INTO $tablaBD (id_doctor, id_consultorio, nyaP, documento, inicio, fin) VALUES (:id_doctor, :id_consultorio, :nyaP, :documento, :inicio, :fin)");

        $pdo->bindParam(":id_doctor", $datosC["Did"], PDO::PARAM_INT);
        $pdo->bindParam(":id_consultorio", $datosC["Cid"], PDO::PARAM_INT);
        $pdo->bindParam(":nyaP", $datosC["nombreP"], PDO::PARAM_STR);
        $pdo->bindParam(":documento", $datosC["documentoP"], PDO::PARAM_STR);
        $pdo->bindParam(":inicio", $datosC["fyhIC"], PDO::PARAM_STR);
        $pdo->bindParam(":fin", $datosC["fyhFC"], PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        }

        $pdo->close();
        $pdo = null;

    }

}
