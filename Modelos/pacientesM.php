<?php

require_once "ConexionBD.php";

class PacientesM extends ConexionBD
{

    //Crear Pacientes_temp
    public static function CrearPacienteM($tablaBD, $datosC)
    {

        $pdo = ConexionBD::cBD()->prepare("INSERT INTO $tablaBD(apellido, nombre, documento, correo,usuario, clave, rol, telefono, direccion) VALUES (:apellido, :nombre, :documento, :correo,:usuario, :clave, :rol, :telefono, :direccion)");
        $pdo->bindParam(":apellido", $datosC["apellido"], PDO::PARAM_STR);
        $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam(":documento", $datosC["documento"], PDO::PARAM_STR);
        $pdo->bindParam(":correo", $datosC["correo"], PDO::PARAM_STR);
        $pdo->bindParam(":usuario", $datosC["usuario"], PDO::PARAM_STR);
        $pdo->bindParam(":clave", $datosC["clave"], PDO::PARAM_STR);
        $pdo->bindParam(":rol", $datosC["rol"], PDO::PARAM_STR);
        $pdo->bindParam(":telefono", $datosC["telefono"], PDO::PARAM_STR);
        $pdo->bindParam(":direccion", $datosC["direccion"], PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        }
        $pdo->close();
        $pdo = null;
    }

    public static function CheckUser($user)
    {
        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM paciente_temp where usuario = :user");
        $pdo->bindParam(":user", $user, PDO::PARAM_STR);
        $pdo->execute();
        $resultado = $pdo->fetchAll();
        if (isset($resultado[0])) {
            return true;
        } else {
            $pdo2 = ConexionBD::cBD()->prepare("SELECT * FROM pacientes where usuario = :user");
            $pdo2->bindParam(":user", $user, PDO::PARAM_STR);
            $pdo2->execute();
            $resultado2 = $pdo->fetch();
            if (isset($resultado2[0])) {
                return true;
            } else {
                return false;
            }
        }

    }

    //Crear Pacientes
    public static function CrearPacienteTempM($datosC)
    {
        if (PacientesM::CheckUser($datosC["usuario"]) == false) {

            $d = mt_rand(1000, 9999);
            $pdo = ConexionBD::cBD()->prepare("INSERT INTO `paciente_temp`(`apellido`, `nombre`, `documento`, `telefono`,`direccion`,`correo`, `usuario`, `clave`, `verificode`,`Estado` ) VALUES (:apellido, :nombre, :documento,  :telefono, :direccion, :correo,:usuario, :clave, :code, false)");
            $pdo->bindParam(":apellido", $datosC["apellido"], PDO::PARAM_STR);
            $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
            $pdo->bindParam(":documento", $datosC["documento"], PDO::PARAM_STR);
            $pdo->bindParam(":correo", $datosC["correo"], PDO::PARAM_STR);
            $pdo->bindParam(":usuario", $datosC["usuario"], PDO::PARAM_STR);
            $pdo->bindParam(":clave", $datosC["clave"], PDO::PARAM_STR);
            $pdo->bindParam(":telefono", $datosC["telefono"], PDO::PARAM_STR);
            $pdo->bindParam(":direccion", $datosC["direccion"], PDO::PARAM_STR);

            $pdo->bindParam(":code", $d, PDO::PARAM_INT);
            if ($pdo->execute()) {

                try {
                    $resultado3 = PacientesM::IngresarPacienteM2("paciente_temp", $datosC);
                    PacientesM::email_send($d, $datosC["nombre"], $datosC["apellido"], $datosC["correo"], $resultado3["id"]);
                    return $resultado3["id"];
                } catch (Exception $e) {
                    return $e->getMessage();
                }
            }
            $pdo = null;
            $pdo->close();
        } else {
            return false;
        }

    }

    private static function email_send($code, $name, $apellido, $correo, $id)
    {
        $message = "<html><body>";

        $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";

        $message .= "<tr><td>";

        $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";

        $message .= "<thead>
<tr height='80'>
<th ><div style='background-color: white;'> <img width='300px' src='https://cecip.com.do/site/templates/cecip/images/cecip-logo.png' /></div></th>
</tr>
     </thead>";

        $message .= "<tbody>
     <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>

</tr>

<tr>
<td colspan='4' style='padding:15px;'>
<p style='font-size:20px;'>Hola <b> " . $_POST["nombres"] . " " . $_POST["apellidos"] . "</b>, Gracias por registrarte.</p>
<hr />
<p style='font-size:25px;'>TU CÓDIGO DE VERIFICACIÓN ES:</p>
<p style='font-size:40px;  font-family:Verdana, Geneva, sans-serif;'>" . $code . "</p>
<a width='100%'; style='background-color: green; color: white;' href=http://localhost/clinica/codeVeri?id=" . $id . ">Ir a la página</a>
</td>
</tr>

      </tbody>";

        $message .= "</table>";

        $message .= "</td></tr>";
        $message .= "</table>";

        $message .= "</body></html>";
        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        mail($correo, "Confirmación de Registro", $message, $cabeceras);
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

        $pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET apellido = :apellido, nombre = :nombre, documento = :documento, usuario = :usuario, correo = :correo, clave = :clave, telefono = :telefono, direccion = :direccion  WHERE id = :id");

        $pdo->bindParam("id", $datosC["id"], PDO::PARAM_INT);
        $pdo->bindParam("apellido", $datosC["apellido"], PDO::PARAM_STR);
        $pdo->bindParam("nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam("documento", $datosC["documento"], PDO::PARAM_STR);
        $pdo->bindParam("correo", $datosC["correo"], PDO::PARAM_STR);
        $pdo->bindParam("usuario", $datosC["usuario"], PDO::PARAM_STR);
        $pdo->bindParam("clave", $datosC["clave"], PDO::PARAM_STR);
        $pdo->bindParam("telefono", $datosC["telefono"], PDO::PARAM_STR);
        $pdo->bindParam("direccion", $datosC["direccion"], PDO::PARAM_STR);

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

    //Ingreso de los Pacientes
    public static function IngresarPacienteM2($tablaBD, $datosC)
    {

        $pdo = ConexionBD::cBD()->prepare("SELECT  id FROM $tablaBD WHERE usuario = :usuario");
        $pdo->bindParam(":usuario", $datosC["usuario"], PDO::PARAM_STR);
        $pdo->execute();
        return $pdo->fetch();
        $pdo->close();
        $pdo = null;

    }

    //Ver Perfil del Paciente
    public static function VerPerfilPacienteM($tablaBD, $id)
    {

        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE id = :id");

        $pdo->bindParam(":id", $id, PDO::PARAM_INT);

        $pdo->execute();

        return $pdo->fetch();

        $pdo->close();
        $pdo = null;

    }

    //Actualizar perfil del Paciente
    public static function ActualizarPerfilPacienteM($tablaBD, $datosC)
    {

        $pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET usuario = :usuario, clave = :clave, nombre = :nombre, apellido = :apellido, documento = :documento, correo = :correo, foto = :foto, telefono = :telefono, direccion = :direccion WHERE id = :id");

        $pdo->bindParam(":id", $datosC["id"], PDO::PARAM_INT);
        $pdo->bindParam(":usuario", $datosC["usuario"], PDO::PARAM_STR);
        $pdo->bindParam(":clave", $datosC["clave"], PDO::PARAM_STR);
        $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam(":apellido", $datosC["apellido"], PDO::PARAM_STR);
        $pdo->bindParam(":documento", $datosC["documento"], PDO::PARAM_STR);
        $pdo->bindParam(":correo", $datosC["correo"], PDO::PARAM_STR);
        $pdo->bindParam(":telefono", $datosC["telefono"], PDO::PARAM_STR);
        $pdo->bindParam(":direccion", $datosC["direccion"], PDO::PARAM_STR);

        $pdo->bindParam(":foto", $datosC["foto"], PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        }

        $pdo->close();
        $pdo = null;

    }

}
