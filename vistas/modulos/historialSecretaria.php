<?php

if ($_SESSION["rol"] != "Secretaria") {

    echo '<script>

	window.location = "inicio";
	</script>';

    return;

}
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Historial de Pacientes</h1>
	</section>
	<section class="content">
		<div class="box">
			<div class="box-body">
				<table class="table table-bordered table-hover table-striped DT">
					<thead>
						<tr>
							<th>Fecha y Hora</th>
							<th>Doctor</th>
							<th>Consultorio</th>
							<th>Borrar</th>
						</tr>

					</thead>

					<tbody>

						<?php
$resultado = CitasC::VerCitasC();
foreach ($resultado as $key => $value) {
    echo '<tr>
		<td>' . $value["inicio"] . '</td>';
    $columna = "id";
    $valor = $value["id_doctor"];
    $doctor = DoctoresC::DoctorC($columna, $valor);
    echo '<td>' . $doctor["apellido"] . ' ' . $doctor["nombre"] . '</td>';
    $columna = "id";
    $valor = $value["id_consultorio"];
    $consultorio = ConsultoriosC::VerConsultoriosC($columna, $valor);
    echo '<td>' . $consultorio["nombre"] . '</td>
									<td>
										<div class="btn-group">


											<a href="' . $_SERVER . 'clinica/historialSecretaria/' . $value["id"] . '">

											<button class="btn btn-danger"><i class="fa fa-times"></i> Borrar</button>


										</div>

									</td>

								 </tr>';

}

?>

					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>


<?php

$borrarV = new HistorialSecretariaC();
$borrarV->BorrarHistorialSecretariaC();
?>

<script>
	var valor= moment('2021-08-12:10:00:00').isBetween('2021-08-12:10:00:00','2021-08-12:17:00:00');
	console.log(valor);
</script>