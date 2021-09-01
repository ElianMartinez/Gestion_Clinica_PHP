<?php

if ($_SESSION["rol"] != "Paciente") {

    echo '<script>

	window.location = "inicio";
	</script>';

    return;

}

?>

<div class="content-wrapper">

	<section class="content-header">

		<h1>Su Historial de Citas Médicas</h1>

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

$resultado = CitasC::VerCitasPacienteC($_SESSION["id"]);
foreach ($resultado as $key => $value) {

    echo '<tr><td>' . $value["inicio"] . '</td>';
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
											<a onClick="borrarL(' . $value["id"] . ');">
											<button class="btn btn-danger"><i class="fa fa-ban"></i> Cancelar</button>
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

$borrarH = new HistorialC();
$borrarH->BorrarHistorialC();

?>
<script>

function borrarL(id) {
	Swal.fire({
  title: '<div style="font-size: 30px">Estas Seguro?</div>',
  showDenyButton: true,
  confirmButtonText: `<div style="font-size: 30px">Si</div>`,
  denyButtonText: `<div style="font-size: 30px">No</div>`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    window.location = "<?php echo $_SERVER ?>clinica/historial/"+id;
  }
});
}
</script>