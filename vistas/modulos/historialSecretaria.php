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
											<button class="btn btn-danger"><i class="fa fa-ban"></i> Cancelar</button>
											</a>
											<button data-toggle="modal" data-target="#smallShoes" onClick="editarCita(' . $value["id"] . ',`' . $value["inicio"] . '`,`' . $doctor["horarioE"] . '`,`' . $doctor["horarioS"] . '`,' . $doctor["id"] . ',`' . $doctor["nombre"] . ' ' . $doctor["apellido"] . '`, ' . $value["id_paciente"] . ');" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar</button>
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

<div class="container-fluid">

<!-- The modal -->
<div class="modal fade" id="smallShoes" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span style="font-size: 20px;" aria-hidden="true">&times;</span>
</button>
<h3 class="modal-title" id="modalLabelSmall">Cambio de Hora</h3>
</div>

<div class="modal-body">
<div class="container">

  <div class="row">
	  <form id="formww" action="#">
		 <select style="font-size: 35px;" id="timecontrol">
			 <option value="00">12 AM</option>
			 <option value="1">1 AM</option>
			 <option value="2">2 AM</option>
			 <option value="3">3 AM</option>
			 <option value="4">4 AM</option>
			 <option value="5">5 AM</option>
			 <option value="6">6 AM</option>
			 <option value="7">7 AM</option>
			 <option value="8">8 AM</option>
			 <option value="9">9 AM</option>
			 <option value="10">10 AM</option>
			 <option value="11">11 AM</option>
			 <option value="12">12 PM</option>
			 <option value="13">1 PM</option>
			 <option value="14">2 PM</option>
			 <option value="15">3 PM</option>
			 <option value="16">4 PM</option>
			 <option value="17">5 PM</option>
			 <option value="18">6 PM</option>
			 <option value="19">7 PM</option>
			 <option value="20">8 PM</option>
			 <option value="21">9 PM</option>
			 <option value="22">10 PM</option>
			 <option value="23">11 PM</option>
		 </select>
			<input class=" btn btn-success" style="font-size: 30px;" type="submit" value="Cambiar" />
	  </form>
	</div>

   </div>
</div>

</div>

</div>
</div>
</div>

</div>
</div>



<?php
$borrarV = new HistorialSecretariaC();
$borrarV->BorrarHistorialSecretariaC();
?>
<script>
var horaI, horaS;
var res =[];
var fechaOriginal;
var newD = new FormData();
	function editarCita(id, fecha,he,hs,idDoc,nombre, idPaciente){
		for (var key of newD.keys()) {
        newD.delete(key);
    }
		fechaOriginal = fecha;
  $('[data-toggle="tooltip"]').tooltip();
  $('[data-toggle="popover"]').popover();
  horaI = he.split(":")[0];
  horaS = hs.split(":")[0];
console.log(idDoc);
  busCitas(idDoc);
  newD.append("idCita", id);
  newD.append("nombreDoctor", nombre);
  newD.append("idDoct", idDoc);
  newD.append("idPa",idPaciente);

}

	$("#formww").submit((e) => {
	 e.preventDefault();
	 const val = $("#timecontrol").val();
	 var hora = val.split(":")[0];
	 var actual = parseInt(hora);
	 var Inicio =parseInt(horaI);
	 var Final =parseInt(horaS);

	 if(actual >= Inicio && actual < Final)
	 {
	   if(res.includes(actual) === false){
  	    const date = moment(fechaOriginal);
  	date.set({
  	hour:actual,
  	minute:0,
  	second:0,
  	millisecond:0
  });

  newD.append("fechaI", date.format());
  newD.append("fechaF", date.add(1,'h').format());

  $.ajax({
    url: "<?php echo $_SERVER; ?>clinica/Ajax/pacientesA.php",
    method: "POST",
    data: newD,
    cache: false,
    contentType: false,
    processData: false,
    success: function (resultado) {
		if(resultado == true){
			location.reload();
		}else{
			alert("Ocurrio un error intentelo nuevamente...")
		}
}
  });

console.log(date.format());
		}else{
			alert("Esa hora está ocupada");
		}
	 }else{
		 alert("La hora no puede ser menor a "+ moment(`2020/05/25 ${Inicio}:00:00`).format("hh:mm") +" ni mayor a " + moment(`2020/05/25 ${Final}:00:00`).format("hh:mm"));
	 }


	});

	function busCitas(id){
		var datos = new FormData();
  datos.append("idDoctor", id);
		$.ajax({
    url: "<?php echo $_SERVER; ?>clinica/Ajax/pacientesA.php",
    method: "POST",
    data: datos,
    dataType: "json",
    cache: false,
    contentType: false,
    processData: false,
    success: function (resultado) {

res = [];
		resultado.map((i)=> {
			res.push(parseInt(i.inicio.split(" ")[1].split(":")[0]));
		});


}
  });
}
</script>