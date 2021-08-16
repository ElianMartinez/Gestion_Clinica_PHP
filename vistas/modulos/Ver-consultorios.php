<?php

if($_SESSION["rol"] != "Paciente"){

	echo '<script>

	window.location = "inicio";
	</script>';

	return;

}


?>

<div class="content-wrapper">
	
	<section class="content-header">
		
		<h1>Elija un Consultorio:</h1>

	</section>

	<section class="content">
		
		<div class="box">
			


			<div class="box-body">

				<?php

			$columna = null;
			$valor = null;

			$resultado = ConsultoriosC::VerConsultoriosC($columna, $valor);

			foreach ($resultado as $key => $value) {

				echo '<div class="col-lg-5 col-xs-6">
          
				          <div class="small-box bg-red">
				            <div class="inner">
				            	<div class="icon">
             					 <i class="fa fa-heartbeat"></i>
           						 </div>

				              <h3>'.$value["nombre"].'</h3>';

				              $columna = "id_consultorio";
				              $valor = $value["id"];

				              $doctores = DoctoresC::VerDoctoresC($columna, $valor);

				              foreach ($doctores as $key => $value) {
				              	

				              	echo '<a href="Doctor/'.$value["id"].'" style="color: black;"><p>'.$value["apellido"].' '.$value["nombre"].'</p></a>';
				              }

				               
				            echo '</div>
				           
				           
				          </div>
				        </div>';
			}

			?>

				
	
			</div>

		</div>

	</section>

</div>


