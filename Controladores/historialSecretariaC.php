<?php

class HistorialSecretariaC{

public function BorrarHistorialSecretariaC(){

	if(substr($_GET["url"], 20)){

			$tablaBD = "citas";

			$id = substr($_GET["url"], 20);

			$resultado = HistorialSecretariaM::BorrarHistoriaSecretariaM($tablaBD, $id);

			if($resultado == true){

				echo '<script>

				window.location = "http://localhost/clinica/historialSecretaria";
				</script>';

			}

		}

	}
}