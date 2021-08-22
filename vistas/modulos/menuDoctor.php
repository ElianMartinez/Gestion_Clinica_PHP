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
          <?php
echo '<a href="' . $_SERVER . 'clinica/Citas/' . $_SESSION["id"] . '">';
?>

            <i class="fa fa-medkit"></i>
            <span>Citas</span>
          </a>
        </li>

        <li>

       <a href="<?php echo $_SERVER; ?>clinica/pacientes">
            <i class="fa fa-calendar-check-o"></i>
            <span>Pacientes</span>
          </a>
        </li>

      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>