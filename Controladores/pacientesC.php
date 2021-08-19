<?php

class PacientesC
{
    //Crear Pacientes
    public function CrearPacienteC()
    {
        if (isset($_POST["rolP"])) {
            $tablaBD = "pacientes";
            $datosC = array("apellido" => $_POST["apellido"], "nombre" => $_POST["nombre"], "documento" => $_POST["documento"], "usuario" => $_POST["usuario"], "clave" => $_POST["clave"], "rol" => $_POST["rolP"], "correo" => $_POST["correo"], "direccion" => $_POST["direccion"], "telefono" => $_POST["telefono"]);
            $resultado = PacientesM::CrearPacienteM($tablaBD, $datosC);
            if ($resultado == true) {
                echo '<script>window.location = "pacientes";</script>';
            }
        }

    }

    //Ver Pacientes
    public static function VerPacientesC($columna, $valor)
    {

        $tablaBD = "pacientes";

        $resultado = PacientesM::VerPacientesM($tablaBD, $columna, $valor);

        return $resultado;
    }

    public function VerCode($id, $num)
    {
        return PacientesM::VerCodeM($id, $num);
    }

    //Borrar Paciente
    public function BorrarPacienteC()
    {

        if (isset($_GET["Pid"])) {

            $tablaBD = "pacientes";

            $id = $_GET["Pid"];

            if ($_GET["imgP"] != "") {

                unlink($_GET["imgP"]);

            }

            $resultado = PacientesM::BorrarPacienteM($tablaBD, $id);
            if ($resultado == true) {
                echo '<script>
				window.location = "pacientes";
				</script>';
            }
        }
    }
    //Actualizar Paciente
    public function ActualizarPacienteC()
    {
        if (isset($_POST["Pid"])) {
            $tablaBD = "pacientes";
            $datosC = array("id" => $_POST["Pid"], "apellido" => $_POST["apellidoE"], "nombre" => $_POST["nombreE"], "documento" => $_POST["documentoE"], "usuario" => $_POST["usuarioE"], "clave" => $_POST["claveE"], "correo" => $_POST["correoE"], "telefono" => $_POST["telefonoE"], "direccion" => $_POST["direccionE"]);
            $resultado = PacientesM::ActualizarPacienteM($tablaBD, $datosC);
            if ($resultado == true) {
                echo '<script>
				window.location = "pacientes";
				</script>';

            }

        }

    }
    //Ingreso de los Pacientes
    public function RegistrarPacienteC($datosC)
    {
        $resultado = PacientesM::CrearPacienteTempM($datosC);
        if ($resultado > 0) {
            return $resultado;
        } else if ($resultado == false) {
            return $resultado;
        }
    }

    //Ingreso de los Pacientes
    public function IngresarPacienteC()
    {
        if (isset($_POST["usuario-Ing"])) {

            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario-Ing"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["clave-Ing"])) {

                $tablaBD = "pacientes";

                $datosC = array("usuario" => $_POST["usuario-Ing"], "clave" => $_POST["clave-Ing"]);

                $resultado = PacientesM::IngresarPacienteM($tablaBD, $datosC);

                if ($resultado["usuario"] == $_POST["usuario-Ing"] && $resultado["clave"] == $_POST["clave-Ing"]) {

                    $_SESSION["Ingresar"] = true;
                    $_SESSION["id"] = $resultado["id"];
                    $_SESSION["usuario"] = $resultado["usuario"];
                    $_SESSION["clave"] = $resultado["clave"];
                    $_SESSION["apellido"] = $resultado["apellido"];
                    $_SESSION["nombre"] = $resultado["nombre"];
                    $_SESSION["documento"] = $resultado["documento"];
                    $_SESSION["foto"] = $resultado["foto"];
                    $_SESSION["rol"] = $resultado["rol"];

                    echo '<script>
					window.location = "inicio";
					</script>';

                } else {

                    echo '<br><div class="alert alert-danger">Error al Ingresar</div>';

                }

            }

        }

    }

    //Ver perfil del paciente
    public function VerPerfilPacienteC()
    {

        $tablaBD = "pacientes";
        $id = $_SESSION["id"];
        $resultado = PacientesM::VerPerfilPacienteM($tablaBD, $id);

        echo '<tr>

				<td>' . $resultado["usuario"] . '</td>
				<td>' . $resultado["clave"] . '</td>
				<td>' . $resultado["nombre"] . '</td>
				<td>' . $resultado["apellido"] . '</td>';

        if ($resultado["foto"] == "") {
            echo '<td><img src="Vistas/img/defecto.png" width="40px"></td>';
        } else {
            echo '<td><img src="' . $resultado["foto"] . '" width="40px"></td>';
        }

        echo '<td>' . $resultado["correo"] . '</td>
        <td>' . $resultado["documento"] . '</td>
        <td>' . $resultado["telefono"] . '</td>
        <td>' . $resultado["direccion"] . '</td>
				<td>
					<a href="' . $_SERVER . 'clinica/perfil-P/' . $resultado["id"] . '">
						<button class="btn btn-success"><i class="fa fa-pencil"></i></button>
					</a>
				</td>
			</tr>

            ';
    }

    //Editar Perfil Paceinte
    public function EditarPerfilPacienteC()
    {

        $tablaBD = "pacientes";

        $id = $_SESSION["id"];

        $resultado = PacientesM::VerPerfilPacienteM($tablaBD, $id);

        echo '<form method="post" enctype="multipart/form-data">

					<div class="row">
						<div class="col-md-4 col-xs-12">
							<h2>Nombre:</h2>
							<input type="text" class="input-lg" name="nombrePerfil" value="' . $resultado["nombre"] . '">
							<input type="hidden" class="input-lg" name="Pid" value="' . $resultado["id"] . '">
							<h2>Apellido:</h2>
							<input type="text" class="input-lg" name="apellidoPerfil" value="' . $resultado["apellido"] . '">
							<h2>Usuario:</h2>
							<input type="text" class="input-lg" name="usuarioPerfil" value="' . $resultado["usuario"] . '">
							<h2>Correo:</h2>
							<input type="text" class="input-lg" name="correoPerfil" value="' . $resultado["correo"] . '">
							</div>
                            <div class="col-md-4 col-xs-12">
                            <h2>Clave:</h2>
							<input type="text" class="input-lg" name="clavePerfil" value="' . $resultado["clave"] . '">
							<h2>Documento:</h2>
							<input type="text" class="input-lg" name="documentoPerfil" value="' . $resultado["documento"] . '">
                            <h2>Teléfono:</h2>
							<input type="text" class="input-lg" name="telefonoPerfil" value="' . $resultado["telefono"] . '">
                            <h2>Dirección:</h2>
							<input type="text" class="input-lg" name="direccionPerfil" value="' . $resultado["direccion"] . '">
							</div>



						<div class="col-md-4 col-xs-12">

							<br><br>

							<input type="file" name="imgPerfil">
							<br>';

        if ($resultado["foto"] != "") {

            echo '<img src="' . $_SERVER . 'clinica/' . $resultado["foto"] . '" width="200px" class="img-responsive">';

        } else {

            echo '<img src="' . $_SERVER . 'clinica/Vistas/img/defecto.png" width="200px" class="img-responsive">';

        }

        echo '<input type="hidden" name="imgActual" value="' . $resultado["foto"] . '">

							<br><br>

							<button type="submit" class="btn btn-success">Guardar Cambios</button>

						</div>

					</div>

				</form>';

    }

    //Actualizar Perfil del Paciente
    public function ActualizarPerfilPacienteC()
    {
        if (isset($_POST["Pid"])) {
            $rutaImg = $_POST["imgActual"];

            if (isset($_FILES["imgPerfil"]["tmp_name"]) && !empty($_FILES["imgPerfil"]["tmp_name"])) {
                if (!empty($_POST["imgActual"])) {
                    unlink($_POST["imgActual"]);
                }

                if ($_FILES["imgPerfil"]["type"] == "image/png") {
                    $nombre = mt_rand(100, 999);
                    $rutaImg = "Vistas/img/Pacientes/Paciente" . $nombre . ".png";
                    $foto = imagecreatefrompng($_FILES["imgPerfil"]["tmp_name"]);
                    imagepng($foto, $rutaImg);
                }

                if ($_FILES["imgPerfil"]["type"] == "image/jpeg") {

                    $nombre = mt_rand(100, 999);

                    $rutaImg = "Vistas/img/Pacientes/Paciente" . $nombre . ".jpg";

                    $foto = imagecreatefromjpeg($_FILES["imgPerfil"]["tmp_name"]);

                    imagejpeg($foto, $rutaImg);
                }
            }

            $tablaBD = "pacientes";
            $datosC = array("id" => $_POST["Pid"], "nombre" => $_POST["nombrePerfil"], "apellido" => $_POST["apellidoPerfil"], "usuario" => $_POST["usuarioPerfil"], "clave" => $_POST["clavePerfil"], "documento" => $_POST["documentoPerfil"], "correo" => $_POST["correoPerfil"], "telefono" => $_POST["telefonoPerfil"], "direccion" => $_POST["direccionPerfil"], "foto" => $rutaImg);
            $resultado = PacientesM::ActualizarPerfilPacienteM($tablaBD, $datosC);
            if ($resultado == true) {
                echo '<script>
				window.location = "' . $_SERVER . 'clinica/perfil-P/' . $_SESSION["id"] . '";
				</script>';
            }
        }
    }
}
