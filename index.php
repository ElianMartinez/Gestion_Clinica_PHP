<?php
include "core/config.php";
session_start();
$_SESSION['HTTP_DIR'] = $_SERVER;
header("Access-Control-Allow-Origin: *");

include dirname(__FILE__) . "Controladores/secretariasC.php";
include dirname(__FILE__) . "Modelos/secretariasM.php";

include dirname(__FILE__) . "Controladores/consultoriosC.php";
include dirname(__FILE__) . "Modelos/consultoriosM.php";

include dirname(__FILE__) . "Controladores/doctoresC.php";
include dirname(__FILE__) . "Modelos/doctoresM.php";

include dirname(__FILE__) . "Controladores/pacientesC.php";
include dirname(__FILE__) . "Modelos/pacientesM.php";

include dirname(__FILE__) . "Controladores/citasC.php";
include dirname(__FILE__) . "Modelos/citasM.php";

include dirname(__FILE__) . "Controladores/adminC.php";
include dirname(__FILE__) . "Modelos/adminM.php";

include dirname(__FILE__) . "Controladores/inicioC.php";
include dirname(__FILE__) . "Modelos/inicioM.php";

include dirname(__FILE__) . "Controladores/historialC.php";
include dirname(__FILE__) . "Modelos/historialM.php";

include dirname(__FILE__) . "Controladores/historialSecretariaC.php";
include dirname(__FILE__) . "Modelos/historialSecretariaM.php";

include dirname(__FILE__) . "vistas/plantilla.php";
