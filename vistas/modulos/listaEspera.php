<style>
  /* ALL LOADERS */

  .loader {
    width: 50px;
    height: 50px;
    border-radius: 100%;
    position: relative;
    margin: 10px auto;
  }

  .disabled2 {
    display: none;
  }
  /* LOADER 1 */

  .loader:before,
  .loader:after {
    content: "";
    position: absolute;
    top: -10px;
    left: -10px;
    width: 100%;
    height: 100%;
    border-radius: 100%;
    border: 10px solid transparent;
    border-top-color: #3498db;
  }

  .loader:before {
    z-index: 100;
    animation: spin 1s infinite;
  }

  .loader:after {
    border: 10px solid #ccc;
  }

  @keyframes spin {
    0% {
      -webkit-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
</style>
<h2 style="margin: 20px">Lista de espera de usuarios</h2>
<div
  id="menu"
  class="overflow-auto"
  style="margin: 20px; overflow: auto; height: 300px"
>
  <div class="panel list-group" id="panel-user-wait"></div>
</div>

<script>
  $(document).ready(() => {
    buscar();
  });

  function buscar(){
    const formDara = new FormData();
    formDara.append("verUsuariosWait", "hola");

    $.ajax({
      url: "Ajax/pacientesA.php",
      method: "POST",
      data: formDara,
      cache: false,
      contentType: false,
      processData: false,
      success: function (resultado) {
        var noti = JSON.parse(resultado);
        mapping(noti);
        console.log(noti);
      },
    });
  }

  function mapping(datos) {
    $("#panel-user-wait").empty();
    var html = "";
    datos.map((i) => {
      html += `
        <a
        href="#"
        class="list-group-item"
        data-toggle="collapse"
        data-target="#${i.id}"
        data-parent="#menu"
        >
        <b> ${i.nombre} ${i.apellido}</b> 
    </a>
      <div id="${i.id}" class="sublinks collapse">
        <a class="list-group-item small"
          ><b>Nombre</b>: ${i.nombre}</a
        >
        <a class="list-group-item small"
          > <b>Apellidos</b>: ${i.apellido}</a
        >
        <a class="list-group-item small"
          > <b>Documento</b>: ${i.documento}</a
        >
        <a class="list-group-item small"
          > <b>Correo</b>: ${i.correo}</a
        >
        <div style="margin: 10px;">
            <div class="col-md-3 bg ">
        <div id='loader${i.id}' class="loader disabled2"></div>
        </div>
     
            <button id='botonA${i.id}' class="btn btn-danger" onClick="recha(${i.id}, '${i.usuario}', '${i.clave}','${i.correo}','${i.nombre} ${i.apellido}');">  <i class="fa fa-times"></i> Rechazar</button>
            <button id='botonR${i.id}' class="btn btn-success" onClick="apect(${i.id}, '${i.usuario}', '${i.clave}','${i.correo}','${i.nombre} ${i.apellido}');"><i class="fa fa-check"></i> Aceptar</button>
        </div>
      
      </div>
        `;
    });
    $("#panel-user-wait").append(html);
  }

  function recha(id, user, pass, correo, nombrecompletp) {
    const formDara = new FormData();
    formDara.append("userA", user);
    formDara.append("passA", pass);
    formDara.append("idA", id);
    formDara.append("correoA", correo);
    formDara.append("namecompleto", nombrecompletp);
    formDara.append("S", "R");

    var botonA = document.getElementById(`botonA${id}`);
    var botonR = document.getElementById(`botonR${id}`);
    var loader = document.getElementById(`loader${id}`);

    $.ajax({
      url: "Ajax/pacientesA.php",
      method: "POST",
      data: formDara,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
        botonA.classList.add("disabled2");
        botonR.classList.add("disabled2");
        loader.classList.remove("disabled2");
      },
      success: function (resultado) {
        buscar();
        botonA.classList.remove("disabled2");
        botonR.classList.remove("disabled2");
        loader.classList.add("disabled2");

        console.log(resultado);
      },
    });
  }
  function apect(id, user, pass, correo, nombrecompletp) {
    const formDara = new FormData();
    formDara.append("userA", user);
    formDara.append("passA", pass);
    formDara.append("idA", id);
    formDara.append("correoA", correo);
    formDara.append("namecompleto", nombrecompletp);
    formDara.append("S", "A");

    var botonA = document.getElementById(`botonA${id}`);
    var botonR = document.getElementById(`botonR${id}`);
    var loader = document.getElementById(`loader${id}`);

    $.ajax({
      url: "Ajax/pacientesA.php",
      method: "POST",
      data: formDara,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
        botonA.classList.add("disabled2");
        botonR.classList.add("disabled2");
        loader.classList.remove("disabled2");
      },
      success: function (resultado) {
        buscar();
        botonA.classList.remove("disabled2");
        botonR.classList.remove("disabled2");
        loader.classList.add("disabled2");

        console.log(resultado);
      },
    });
  }
</script>
