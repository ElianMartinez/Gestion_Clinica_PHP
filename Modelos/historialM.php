<?php


require_once "ConexionBD.php";

class historialM extends ConexionBD{
//Borrar Secretarias
	
	static public function BorrarHistoriaM($tablaBD, $id){

		$pdo = ConexionBD::cBD()->prepare("DELETE FROM $tablaBD WHERE id = :id");

		$pdo -> bindParam(":id", $id, PDO::PARAM_INT);

		if($pdo -> execute()){

			return true;

		}else{
			return false;
		}

		$pdo -> close();
		$pdo = null;

	}
}

