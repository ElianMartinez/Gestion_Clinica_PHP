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
							<th>Método de Pago</th>
							<th>Pago</th>
							<th>Borrar</th>

						</tr>

					</thead>

					<tbody>

						<?php

$resultado = CitasC::VerCitasPacienteC($_SESSION["id"]);
foreach ($resultado as $key => $value) {

    $mp = "";
    $pa = "";

    if ($value["metodoP"] == "s") {
        $mp = '<button  class="btn"><i style="margin:5px" class="fa fa-shield" aria-hidden="true"></i> Seguro </button>';
    } else {
        $mp = '<button  class="btn"><i style="margin:5px" class="fa fa-money" aria-hidden="true"></i> Efectivo </button>';
    }

    if ($value["pago"] == true) {
        $pa = '<button class="btn btn-success"><i style="margin:5px" class="fa fa-check" aria-hidden="true"></i>Listo </button>';

    } else {
        $pa = '<button class="btn btn-warning"><i style="margin:5px" class="fa fa-ban" aria-hidden="true"></i>No pago </button>';
    }
    echo '<tr><td>' . $value["inicio"] . '</td>';
    $columna = "id";
    $valor = $value["id_doctor"];
    $doctor = DoctoresC::DoctorC($columna, $valor);
    echo '<td>' . $doctor["apellido"] . ' ' . $doctor["nombre"] . '</td>';
    $columna = "id";
    $valor = $value["id_consultorio"];
    $consultorio = ConsultoriosC::VerConsultoriosC($columna, $valor);
    echo '<td>' . $consultorio["nombre"] . '</td>
	<td>' . $mp . '</td>
	<td>' . $pa . '</td>
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
  title: '<div style="font-size: 30px">Estás Seguro?</div>',
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