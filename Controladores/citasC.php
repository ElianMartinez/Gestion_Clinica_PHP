<?php

if (isset($_POST['Enviar'])){

	if(!empty($_POST['nyaC'])){

		$columna = "id";
		$valor = substr($_GET["url"], 7);

		$resultado = DoctoresC::DoctorC($columna, $valor);

		$name = $_POST['nyaC'];
		$hora = $_POST['fyhIA'];
		$horaz = $_POST['fyhFB'];
		$fecha = $_POST['fechaz'];
		$documento = $_POST['documentoC'];
		
		
		$destino = "luiyicuevas123@gmail.com";
		$contenido ="Nombre: " .$name. "\nDocumento: " .$documento.  "\nHa solicitado una cita para la fecha: " .$hora. " hasta " .$horaz."\nFecha: " .$fecha. "\nDoctor: " .$resultado["nombre"]. " " .$resultado["apellido"];

		mail($destino,$name, $contenido);

	}



}


class CitasC{

	//Pedir Cita Paciente
	public function EnviarCitaC(){

		if(isset($_POST["Did"])){

			$tablaBD = "citas";

			$Did = substr($_GET["url"], 7);

			$datosC = array("Did"=>$_POST["Did"], "Pid"=>$_POST["Pid"], "nyaC"=>$_POST["nyaC"], "Cid"=>$_POST["Cid"], "documentoC"=>$_POST["documentoC"], "fyhIC"=>$_POST["fyhIC"], "fyhFC"=>$_POST["fyhFC"],"fyhIA"=>$_POST["fyhIA"], "fyhFB"=>$_POST["fyhFB"], "fyhFB"=>$_POST["fyhFB"], "fechaz"=>$_POST["fechaz"]);

			$resultado = CitasM::EnviarCitaM($tablaBD, $datosC);

			if($resultado == true){

				echo '<script>

				window.location = "Doctor/"'.$Did.';
				</script>';

			}

		}

	}






	//Mostrar Citas
	public function VerCitasC(){

		$tablaBD = "citas";



		$resultado = CitasM::VerCitasM($tablaBD);
		

		return $resultado;

	}



	//Pedir Cita como Doctor
	public function PedirCitaDoctorC(){

		if(isset($_POST["Did"])){

			$tablaBD = "citas";

			$Did = substr($_GET["url"], 6);

			$datosC = array("Did"=>$_POST["Did"], "Cid"=>$_POST["Cid"], "nombreP"=>$_POST["nombreP"], "documentoP"=>$_POST["documentoP"], "fyhIC"=>$_POST["fyhIC"], "fyhFC"=>$_POST["fyhFC"]);

			$resultado = CitasM::PedirCitaDoctorM($tablaBD, $datosC);

			if($resultado == true){


				echo '<script>




				window.location = "Citas/"'.$Did.';
				</script>';


			}




		}



	}

	public function PedirCitaSecretariaC(){

		if(isset($_POST["Did"])){

			$tablaBD = "citas";

			$Did = substr($_GET["url"], 15);

			$datosC = array("Did"=>$_POST["Did"], "Cid"=>$_POST["Cid"], "nombreP"=>$_POST["nombreP"], "documentoP"=>$_POST["documentoP"], "fyhIC"=>$_POST["fyhIC"], "fyhFC"=>$_POST["fyhFC"]);

			$resultado = CitasM::PedirCitaSecretariaM($tablaBD, $datosC);

			if($resultado == true){


				echo '<script>




				window.location = "Citasecretaria/"'.$Did.';
				</script>';


			}




		}



	}


}