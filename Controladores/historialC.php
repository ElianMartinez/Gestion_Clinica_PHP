<?php

class HistorialC{

public function BorrarHistorialC(){

	if(substr($_GET["url"], 10)){

			$tablaBD = "citas";

			$id = substr($_GET["url"], 10);

			$resultado = HistorialM::BorrarHistoriaM($tablaBD, $id);

			if($resultado == true){

				echo '<script>

				window.location = "'.$_SERVER.'clinica/historial";
				</script>';

			}

		}

	}
}