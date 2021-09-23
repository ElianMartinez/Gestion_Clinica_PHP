<body
  style="
    background: url('Vistas/img/fondo.jpg') no-repeat;
    background-size: 100% 100%;
  "
>
  <style>
    body {
      font-size: large;
    }
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3498db;
      width: 120px;
      height: 120px;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% {
        -webkit-transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
      }
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }
    .contenedor {
      display: flex;
      justify-content: center;
      padding: 20px;
    }
    .disabled {
      display: none;
    }

    textarea {
    resize: none;
}
  </style>
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Clínica CECIP</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Registrar Paciente</p>

      <form id="registroUsuarioAuto">
        <div class="form-group has-feedback">
          <input
            type="text"
            class="form-control"
            required
            name="nombres"
            placeholder="Nombres"
          />
        </div>

        <div class="form-group has-feedback">
          <input
            type="text"
            class="form-control"
            required
            name="apellidos"
            placeholder="Apellidos"
          />
        </div>

        <div class="form-group has-email">
          <input
            type="email"
            class="form-control"
            id="mail"
            required
            name="correo"
            placeholder="Correo Electrónico"
          />
        </div>

        <div class="form-group has-feedback">
          <select
            class="form-control"
            required
            id="tipoDocumento"
            name="tipoDocumento"
            placeholder="Tipo de Documento"
          >
            <option value="1">Cédula</option>
            <option value="2">Pasaporte</option>
          </select>
        </div>

        <div class="form-group has-feedback">
          <input
            type="text"
            class="form-control"
            required
            id="noDoc"
            name="noDoc"
            maxlength="11"
            placeholder="Número de Documento"
          />
        </div>
        <div class="form-group has-feedback">
          <input
            type="text"
            class="form-control"
            required
            id="telefono"
            placeholder="Teléfono"
          />
        </div>
        <div class="form-group has-feedback">
          <input
            type="text"
            class="form-control"
            required
            name="usuario-Ing"
            placeholder="Usuario"
          />
        </div>

        <div class="form-group has-feedback">
          <input
            type="password"
            class="form-control"
            id="clave-Ing"
            required
            name="clave-Ing"
            placeholder="Contraseña"
          />
        </div>
        <div class="form-group has-feedback">
          <textarea
          max-width='100%'
            class="form-control"
            required
            id="direccion"
            placeholder="Dirección"
          ></textarea>
        </div>

        <div class="row">
          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">
              Ingresar
            </button>
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-xs-12">
            <a href="ingreso-Paciente" class="btn btn-danger btn-block btn-flat"
              >Volver</a
            >
          </div>
        </div>
        <div id="error"></div>
      </form>
      <div id="loader" class="loader disabled"></div>

    <!-- /.login-box-body -->
  </div>
</body>


<script>
  $("#tipoDocumento").change(e => {
    var valor = $("#tipoDocumento").val();
  if(valor == 1){
   $("#noDoc").attr('minlength','11');
   $("#noDoc").attr('maxlength','11');
    }else{
   $("#noDoc").attr('minlength','11');
   $("#noDoc").attr('maxlength','9');
    }
  })

</script>
