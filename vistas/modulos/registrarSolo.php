<body style="background: url('Vistas/img/fondo.jpg') no-repeat; background-size: 100% 100%;">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Clínica CECIP</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Registrar Paciente</p>

    <form method="post">
    <div class="form-group has-feedback">
        <input type="text" class="form-control" required name="nombres" placeholder="Nombres">
      </div>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" required name="apellidos" placeholder="Apellidos">
      </div>

      <div class="form-group has-email">
        <input type="email" class="form-control" required name="correo" placeholder="Correo Electrónico">
      </div>

      <div class="form-group has-feedback">
        <select class="form-control" required name="tipoDocumento" placeholder="Tipo de Documento">
            <option value="1">Cédula</option>
            <option value="2">Pasaporte</option>
        </select>
      </div>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" required name="noDoc" placeholder="Número de Documento">
      </div>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" required name="usuario-Ing" placeholder="Usuario">
      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" required name="clave-Ing" placeholder="Contraseña">

      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-xs-12">
          <a href="ingreso-Paciente" class="btn btn-danger btn-block btn-flat">Volver</a>
        </div>
      </div>

      <?php

$ingreso = new PacientesC();
$ingreso->RegistrarPacienteC();

?>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
</body>