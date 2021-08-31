<?php

require_once "../Controladores/pacientesC.php";
require_once "../Modelos/pacientesM.php";
require_once "../Modelos/citasM.php";

class PacientesA
{

    public $Pid;

    public function EPacienteA()
    {

        $columna = "id";
        $valor = $this->Pid;
        $resultado = PacientesC::VerPacientesC($columna, $valor);
        echo json_encode($resultado);
    }

    public $Norepetir;

    public function NoRepetirUsuarioA()
    {

        $columna = "usuario";
        $valor = $this->Norepetir;

        $resultado = PacientesC::VerPacientesC($columna, $valor);

        echo $resultado;

    }

}

if (isset($_POST["Pid"])) {

    $editarP = new PacientesA();
    $editarP->Pid = $_POST["Pid"];
    $editarP->EPacienteA();

}

if (isset($_POST["Norepetir"])) {

    $noRepetirU = new PacientesA();
    $noRepetirU->Norepetir = $_POST["Norepetir"];
    $noRepetirU->NoRepetirUsuarioA();
}

if (isset($_POST["usuario-Ing"]) && isset($_POST["clave-Ing"]) && isset($_POST["correo"])) {
    $ingreso = new PacientesC();
    $datosC = array("apellido" => $_POST["apellidos"], "nombre" => $_POST["nombres"], "documento" => $_POST["noDoc"], "usuario" => $_POST["usuario-Ing"], "clave" => $_POST["clave-Ing"], "correo" => $_POST["correo"], "telefono" => $_POST["telefono"], "direccion" => $_POST["direccion"]);

    echo $ingreso->RegistrarPacienteC($datosC);
}

if (isset($_POST["idUserTemp"]) && isset($_POST["num"])) {
    $ingreso = new PacientesC();
    $arr = $ingreso->VerCode($_POST["idUserTemp"], $_POST["num"]);
    echo json_encode($arr);
}

if (isset($_POST["id_user"]) && isset($_POST["tabla"])) {
    $arr = array("id_user" => $_POST["id_user"], "tabla" => $_POST["tabla"]);
    $retorno = PacientesM::VerNotification($arr);
    echo json_encode($retorno);
}

if (isset($_POST["id_noti"])) {
    $retorno = PacientesM::UpdateNoti($_POST["id_noti"]);
    echo json_encode($retorno);

}

if (isset($_POST["verUsuariosWait"])) {
    $retorno = PacientesM::VerUsuariosInWait();
    echo json_encode($retorno);
}

if (isset($_POST['userA']) && isset($_POST['passA']) && isset($_POST['idA'])) {
    $arr = array("user" => $_POST['userA'], "pass" => $_POST["passA"], "correo" => $_POST["correoA"], "namelast" => $_POST["namecompleto"], "id" => $_POST["idA"]);
    if ($_POST['S'] == "A") {
        $resp = PacientesM::UpdateUserWait($arr);
        echo $resp;
    } else {
        $resp = PacientesM::CancellUser($arr);
        echo $resp;

    }
}

if (isset($_POST["idDoctor"])) {
    $res = PacientesM::BuscarCitas($_POST["idDoctor"]);
    echo json_encode($res);
}

if (isset($_POST["idCita"]) && isset($_POST["nombreDoctor"]) && isset($_POST["fechaI"]) && isset($_POST["fechaF"])) {
    $array = array("idCita" => $_POST["idCita"], "nameDoc" => $_POST["nombreDoctor"], "fechaF" => $_POST["fechaF"], "fechaI" => $_POST["fechaI"], "idPa" => $_POST["idPa"]);
    echo CitasM::UpdateHous($array);
}
