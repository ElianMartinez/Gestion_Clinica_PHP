$(document).ready(() => {
  $("#registroUsuarioAuto").submit((e) => {
    e.preventDefault();
    $("#error").empty();
    var name = $("input:text[name=nombres]").val();
    var last = $("input:text[name=apellidos]").val();
    var corr = $("#mail").val();
    var tel = $("#telefono").val();
    var dire = $("#direccion").val();
    var noDoc = $("input:text[name=noDoc]").val();
    var user = $("input:text[name=usuario-Ing]").val();
    var clave = $("#clave-Ing").val();

    var datos = new FormData();
    datos.append("nombres", name);
    datos.append("apellidos", last);
    datos.append("correo", corr);
    datos.append("noDoc", noDoc);
    datos.append("usuario-Ing", user);
    datos.append("clave-Ing", clave);
    datos.append("telefono", tel);
    datos.append("direccion", dire);



    $.ajax({
      url: "Ajax/pacientesA.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: (res) => {
        $("#registroUsuarioAuto").addClass("disabled");
        $("#loader").removeClass("disabled");
      },
      success: function (resultado) {
        console.log(resultado);
        $("#registroUsuarioAuto").removeClass("disabled");
        $("#loader").addClass("disabled");
        $("#error").empty();
        if (resultado > 0) {
          $("#registroUsuarioAuto")[0].reset();
          $("#error").empty();
          Swal.fire(
            "Buen trabajo!",
            "Revise su correo electrónico para hacer la confirmación.",
            "success"
          );
          Swal.fire({
            title:   '<div style="font-size: 30px">Buen Trabajo!</div>',
            icon: 'success',
            html:'<div style="font-size: 25px"><b>Revise su correo electrónico para hacer la confirmación.</b></div>, '
          });
        } else {
          $("#error").append(
            '<br><div class="alert alert-danger">El usuario ya está registrado</div>'
          );
        }
      },
    });
  });
});


