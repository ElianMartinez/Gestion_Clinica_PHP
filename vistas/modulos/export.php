<div class="content-wrapper">

	<section class="content">

		<div class="box">
			<div class="box-body">
    <h2>Buscar y exportar</h2>

    <div class="row">
    <div class="col-md-4">
        <select id="selectDoct" class="form-control">
        </select>
    </div>
    <div class="col-md-2">
    <input class="form-control" style="background:green; color: white;" type="button" onclick="generate()" value="Export To PDF " />
    </div>
    </div>
            <table id="tableDrop" class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Hora y Fecha entrada</th>
      <th scope="col">Hora y Fecha salida</th>
      <th scope="col">Doctor</th>
      <th scope="col">Paciente</th>
      <th scope="col">Documento</th>
    </tr>
  </thead>
  <tbody id="bodyTable">

  </tbody>
</table>
			</div>

		</div>

	</section>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
<script>
    $(document).ready(() => {
        buscarDoctor();
    });
function buscarDoctor(){
    var newD = new FormData();
    newD.append("b", "hola");
console.log("hoal")
  $.ajax({
    url: "<?php echo $_SERVER ?>clinica/Ajax/doctoresA.php",
    method: "POST",
    data: newD,
    contentType: false,
    cache: false,
    processData: false,
    success: function (re) {
     var resul = JSON.parse(re);

     var html ="<option value='0'>Seleccionar...<option>";
     resul.map( i => {
         html += `<option data="${i.nombre} ${i.apellido}" value="${i.id}">${i.nombre} ${i.apellido}</option>`;
     });

     $("#selectDoct").empty();
     $("#selectDoct").append(html);

    }
  });
}

$("#selectDoct").change(() => {
    buscar($("#selectDoct").val(),$("#selectDoct option:selected").text());
});

function buscar(doctorId, name){
    var newD = new FormData();
    newD.append("DoctorID", doctorId);
    $.ajax({
    url: "<?php echo $_SERVER ?>clinica/Ajax/doctoresA.php",
    method: "POST",
    data: newD,
    contentType: false,
    cache: false,
    processData: false,
    success: function (re) {
     var resul = JSON.parse(re);
     var html = "";
     if(resul.length > 0){
    resul.map( i => {
        html += `<tr>
      <th scope="row">${i.id}</th>
      <td>${i.inicio}</td>
      <td>${i.fin}</td>
      <td>${name}</td>
      <td>${i.nyaP}</td>
      <td>${i.documento}</td>
    </tr>`});
    }else{
        html += "<tr><td colspan='14'>No hay registros para </td></tr>";
    }
     $("#bodyTable").empty();
     $("#bodyTable").append(html);
    }
  });


}


function generate() {
    var doc = new jsPDF('p', 'pt', 'letter');
    var htmlstring = '';
    var tempVarToCheckPageHeight = 0;
    var pageHeight = 0;
    pageHeight = doc.internal.pageSize.height;
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassme': function(element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 150,
        bottom: 60,
        left: 40,
        right: 40,
        width: 600
    };
    var y = 20;
    doc.setLineWidth(2);
    doc.text(100, y = y + 30, "REPORTE DE CITAS DE: " + $("#selectDoct option:selected").text().toUpperCase());
    doc.autoTable({
        html: '#tableDrop',
        startY: 70,
        theme: 'grid',
        styles: {
            minCellHeight: 40
        }
    })
    doc.save('Marks_Of_Students.pdf');
}

</script>