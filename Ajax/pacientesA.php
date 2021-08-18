<?php

require_once "../Controladores/pacientesC.php";
require_once "../Modelos/pacientesM.php";

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

        echo json_encode($resultado);

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
