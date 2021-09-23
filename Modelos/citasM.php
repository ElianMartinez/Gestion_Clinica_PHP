<?php

require_once "ConexionBD.php";

class CitasM extends ConexionBD
{

   public static function EnviarNoti($idPa, $idDoc, $fech ,$tiempa,$idCon) {
       
        $pdo22 = ConexionBD::cBD()->prepare("SELECT * FROM pacientes WHERE id = :id");
        $pdo22->bindParam(":id", $idPa, PDO::PARAM_INT);
        $pdo22->execute();
        $res22 = $pdo22->fetch();

        $pdo883 = ConexionBD::cBD()->prepare("SELECT * FROM doctores WHERE id = :id");
        $pdo883->bindParam(":id", $idDoc, PDO::PARAM_INT);
        $pdo883->execute();
        $res33 = $pdo883->fetch();

        $idD = $res33["id"];
        $msg = 'El paciente ' . $res22["nombre"] . ' ' . $res22["apellido"] . ' ID:' . $idPa . ' ha creado una cita para ' . $fech . ' : ' .$tiempa;
        $msg1 = ' Del doctor ' . $res33["nombre"] . ' ' . $res33["apellido"];
        $msg3 = 'Se ha creado una cita para el ' . $fech . ' : ' .$tiempa . $msg1;
       
        $mstotal = $msg . $msg1;
        $pdo88 = ConexionBD::cBD()->prepare("INSERT INTO `notificaciones` (`id_usuario`, `mensaje`, `leido`, `tabla`) values (:idA, :messa, 0, 'Doctor')");
        $pdo88->bindParam(":idA", $idD, PDO::PARAM_INT);
        $pdo88->bindParam(":messa", $msg, PDO::PARAM_STR);
        $pdo88->execute();

        $pdo2 = ConexionBD::cBD()->prepare("INSERT INTO notificaciones (id_usuario, tabla, mensaje) VALUES (:idp,'Paciente',:msg )");
$pdo2->bindParam(":idp", $idPa, PDO::PARAM_INT);
$pdo2->bindParam(":msg", $msg3, PDO::PARAM_STR);
$pdo2->execute();

        $pdo2 = ConexionBD::cBD()->prepare("INSERT INTO `notificaciones` (`id_usuario`, `mensaje`, `leido`, `tabla`) SELECT  `id`, :messag, 0, 'Secretaria' FROM  `secretarias` WHERE id_consultorio = :idcon");
        $pdo2->bindParam(":messag", $mstotal, PDO::PARAM_STR);
        $pdo2->bindParam(":idcon", $idCon, PDO::PARAM_INT);
        $pdo2->execute();
    }

    public static function EnviarNoti2($idPa, $idDoc, $fech ,$tiempa,$idCon) {
       
        $pdo22 = ConexionBD::cBD()->prepare("SELECT * FROM pacientes WHERE id = :id");
        $pdo22->bindParam(":id", $idPa, PDO::PARAM_INT);
        $pdo22->execute();
        $res22 = $pdo22->fetch();

        $pdo883 = ConexionBD::cBD()->prepare("SELECT * FROM doctores WHERE id = :id");
        $pdo883->bindParam(":id", $idDoc, PDO::PARAM_INT);
        $pdo883->execute();
        $res33 = $pdo883->fetch();

        $idD = $res33["id"];
        $msg = 'Se ha creado una cita para El paciente ' . $res22["nombre"] . ' ' . $res22["apellido"] . ' ID:' . $idPa . '  ' . $fech . ' : ' .$tiempa;
        $msg1 = ' Del doctor ' . $res33["nombre"] . ' ' . $res33["apellido"];
       
        $msg3 = 'Se ha creado una cita para el ' . $fech . ' : ' .$tiempa . $msg1;


        $mstotal = $msg . $msg1;

        $pdo2 = ConexionBD::cBD()->prepare("INSERT INTO notificaciones (id_usuario, tabla, mensaje) VALUES (:idp,'Paciente',:msg )");
        $pdo2->bindParam(":idp", $idPa, PDO::PARAM_INT);
        $pdo2->bindParam(":msg", $msg3, PDO::PARAM_STR);
        $pdo2->execute();
        
        $pdo88 = ConexionBD::cBD()->prepare("INSERT INTO `notificaciones` (`id_usuario`, `mensaje`, `leido`, `tabla`) values (:idA, :messa, 0, 'Doctor')");
        $pdo88->bindParam(":idA", $idD, PDO::PARAM_INT);
        $pdo88->bindParam(":messa", $msg, PDO::PARAM_STR);
        $pdo88->execute();

        $pdo2 = ConexionBD::cBD()->prepare("INSERT INTO `notificaciones` (`id_usuario`, `mensaje`, `leido`, `tabla`) SELECT  `id`, :messag, 0, 'Secretaria' FROM  `secretarias` WHERE id_consultorio = :idcon");
        $pdo2->bindParam(":messag", $mstotal, PDO::PARAM_STR);
        $pdo2->bindParam(":idcon", $idCon, PDO::PARAM_INT);
        $pdo2->execute();
    }

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
            CitasM::EnviarNoti($datosC["Pid"], $datosC["Did"], $datosC["fechaz"] ,$datosC["fyhIA"],$datosC["Cid"]);
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
            CitasM::EnviarNoti2($datosC["pID"], $datosC["Did"], $datosC["fyhIC"] ,$datosC["fyhIA"],$datosC["Cid"]);
            return true;
        }

        $pdo->close();
        $pdo = null;

    }

    //Pedir Cita como Doctor
    public static function PedirCitaSecretariaM($tablaBD, $datosC)
    {

        $pdo = ConexionBD::cBD()->prepare("INSERT INTO $tablaBD (id_doctor, id_consultorio, nyaP, documento, inicio, fin, id_paciente) VALUES (:id_doctor, :id_consultorio, :nyaP, :documento, :inicio, :fin, :idpa)");

        $pdo->bindParam(":id_doctor", $datosC["Did"], PDO::PARAM_INT);
        $pdo->bindParam(":id_consultorio", $datosC["Cid"], PDO::PARAM_INT);
        $pdo->bindParam(":nyaP", $datosC["nombreP"], PDO::PARAM_STR);
        $pdo->bindParam(":documento", $datosC["documentoP"], PDO::PARAM_STR);
        $pdo->bindParam(":inicio", $datosC["fyhIC"], PDO::PARAM_STR);
        $pdo->bindParam(":fin", $datosC["fyhFC"], PDO::PARAM_STR);
        $pdo->bindParam(":idpa", $datosC["pID"], PDO::PARAM_INT);

        if ($pdo->execute()) {
            CitasM::EnviarNoti2($datosC["pID"], $datosC["Did"], $datosC["fyhIC"] ,$datosC["fyhIA"],$datosC["Cid"]);

            return true;
        }

        $pdo->close();
        $pdo = null;

    }

}
