<?php
include "core/config.php";
session_start();
$_SESSION['HTTP_DIR'] = $_SERVER;
header("Access-Control-Allow-Origin: *");
echo "Hello";

require_once dirname(__FILE__) . "Controladores/secretariasC.php";
require_once dirname(__FILE__) . "Modelos/secretariasM.php";

require_once dirname(__FILE__) . "Controladores/consultoriosC.php";
require_once dirname(__FILE__) . "Modelos/consultoriosM.php";

require_once dirname(__FILE__) . "Controladores/doctoresC.php";
require_once dirname(__FILE__) . "Modelos/doctoresM.php";

require_once dirname(__FILE__) . "Controladores/pacientesC.php";
require_once dirname(__FILE__) . "Modelos/pacientesM.php";

require_once dirname(__FILE__) . "Controladores/citasC.php";
require_once dirname(__FILE__) . "Modelos/citasM.php";

require_once dirname(__FILE__) . "Controladores/adminC.php";
require_once dirname(__FILE__) . "Modelos/adminM.php";

require_once dirname(__FILE__) . "Controladores/inicioC.php";
require_once dirname(__FILE__) . "Modelos/inicioM.php";

require_once dirname(__FILE__) . "Controladores/historialC.php";
require_once dirname(__FILE__) . "Modelos/historialM.php";

require_once dirname(__FILE__) . "Controladores/historialSecretariaC.php";
require_once dirname(__FILE__) . "Modelos/historialSecretariaM.php";

include dirname(__FILE__) . "vistas/plantilla.php";
