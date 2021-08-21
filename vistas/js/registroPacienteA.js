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
            title: '<div style="font-size: 30px">Buen Trabajo!</div>',
            icon: "success",
            html: '<div style="font-size: 25px"><b>Revise su correo electrónico para hacer la confirmación.</b></div>, ',
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            window.location = "codeVeri?id=" + resultado;
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


$("#formCode").submit((e) => {
  const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const id = urlParams.get("id");
  e.preventDefault();
  var n1 = $("#p").val() + $("#num2").val() + $("#num3").val() + $("#num4").val();
  var formDara = new FormData();
  formDara.append("num",n1);
  formDara.append("idUserTemp",id);

  
  $.ajax({
    url: "Ajax/pacientesA.php",
    method: "POST",
    data: formDara,
    cache: false,
    contentType: false,
    processData: false,
    beforeSend: (res) => {
      $("#formCode").addClass("disabled");
        $("#loader").removeClass("disabled");
    },
    success: function (resultado) {
      console.log(resultado);
      $("#loader").addClass("disabled");
      $("#formCode").removeClass("disabled");
      if(resultado == "true"){
        Swal.fire({
          title: '<div style="font-size: 20px">Buen Trabajo!</div>',
          icon: "success",
          html: '<div style="font-size: 16px"><b>Llegará un correo con la confirmación de su solicitud. El tiempo máximo es de 24H laborables</b></div>, ',
        }).then((result) => {
          window.location = "/clinica";
        });
      }else if(resultado == "3"){
        Swal.fire({
          title: '<div style="font-size: 20px">Código Activado</div>',
          icon: "info",
          html: '<div style="font-size: 16px"><b>Su registro ya fue verificado</b></div>, ',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          window.location = "/clinica";
        });
      }else{
        Swal.fire({
          title: '<div style="font-size: 20px">Código Erroneo</div>',
          icon: "warning",
          html: '<div style="font-size: 16px"><b>El código está mal escrito</b></div>, ',
        })
      }
    }
  
  });
  
});

$(function () {
  "use strict";

  const queryString = window.location;
  if (queryString.pathname.includes("codeVeri")) {
    var body = $("body");
    $("#p").focus();

    function goToNextInput(e) {
      var key = e.which,
        t = $(e.target),
        sib = t.next("input");

      if (key != 9 && (key < 48 || key > 57) && (key < 96 || key > 105)) {
        e.preventDefault();
        return false;
      }

      if (key === 9) {
        return true;
      }

      if (!sib || !sib.length) {
        sib = body.find("input").eq(0);
      }
      sib.select().focus();
    }

    function onKeyDown(e) {
      var key = e.which;
      if (key === 9 || (key >= 48 && key <= 57) || (key > 95 && key < 106)) {
        return true;
      }
      e.preventDefault();
      return false;
    }
    function onFocus(e) {
      $(e.target).select();
    }

    body.on("keyup", "input", goToNextInput);
    body.on("keydown", "input", onKeyDown);
    body.on("click", "input", onFocus);
  }
});
