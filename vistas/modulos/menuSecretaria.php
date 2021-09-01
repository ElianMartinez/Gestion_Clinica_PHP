<?php

$datos = DoctoresM::verDoCons($_SESSION["idc"]);
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <ul class="sidebar-menu">

        <li>
          <a href="<?php echo $_SERVER; ?>clinica/inicio">
            <i class="fa fa-home"></i>
            <span>Inicio</span>
          </a>
        </li>


         <li>
          <a href="<?php echo $_SERVER; ?>clinica/Citasecretaria/<?php echo $datos["id"]; ?>">
            <i class="fa fa-medkit"></i>
            <span>Agendar Cita</span>
          </a>
        </li>

        <li>
          <a href="<?php echo $_SERVER; ?>clinica/consultorios">
            <i class="fa fa-medkit"></i>
            <span>Consultorios</span>
          </a>
        </li>

        <li>
          <a href="<?php echo $_SERVER; ?>clinica/pacientes">
            <i class="fa fa-users"></i>
            <span>Pacientes</span>
          </a>
        </li>
        <li>

          <a href="<?php echo $_SERVER; ?>clinica/historialSecretaria/">

            <i class="fa fa-calendar-check-o"></i>
            <span>Historial de pacientes</span>
          </a>
        </li>

        <li>
        <?php
echo '  <a href="' . $_SERVER . 'clinica/export/">';
?>
          <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
            <span>Buscar y Exportar</span>
          </a>
        </li>

      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>