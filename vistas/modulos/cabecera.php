<style>
  .dropdown-menu.notify-drop {

  min-width: 330px;
  background-color: #fff;
  min-height: 360px;
  max-height: 360px;
}
.dropdown-menu.notify-drop .notify-drop-title {
  border-bottom: 1px solid #e2e2e2;
  padding: 5px 15px 10px 15px;
}
.dropdown-menu.notify-drop .drop-content {
  min-height: 280px;
  max-height: 280px;
  overflow-y: scroll;
}
.dropdown-menu.notify-drop .drop-content::-webkit-scrollbar-track
{
  background-color: #F5F5F5;
}

.dropdown-menu.notify-drop .drop-content::-webkit-scrollbar
{
  width: 8px;
  background-color: #F5F5F5;
}

.dropdown-menu.notify-drop .drop-content::-webkit-scrollbar-thumb
{
  background-color: #ccc;
}
.dropdown-menu.notify-drop .drop-content > li {
  border-bottom: 1px solid #e2e2e2;
  padding: 10px 0px 5px 0px;

}
.dropdown-menu.notify-drop .drop-content > li:nth-child(2n+0) {
  background-color: #fafafa;
}
.dropdown-menu.notify-drop .drop-content > li:after {
  content: "";
  clear: both;
  display: block;
}
 .dropdown-menu.notify-drop .drop-content > li:hover {
  background-color: #fcfcfc;
}
 .dropdown-menu.notify-drop .drop-content > li:last-child {
  border-bottom: none;
}
.dropdown-menu.notify-drop .drop-content > li .notify-img {
  float: left;
  display: inline-block;
  width: 45px;
  height: 45px;
  margin: 0px 0px 8px 0px;
}
 .dropdown-menu.notify-drop .allRead {
  margin-right: 7px;
}
 .dropdown-menu.notify-drop .rIcon {
  float: right;
  color: #999;
  font-size: 20px;
  cursor: pointer;
}
 .dropdown-menu.notify-drop .rIcon:hover {
  color: #333;
  font-size: 25px;

}
.dropdown-menu.notify-drop .drop-content > li a {
  font-size: 12px;
  font-weight: normal;
}
 .dropdown-menu.notify-drop .drop-content > li {
  font-weight: bold;
  font-size: 11px;
}
 .dropdown-menu.notify-drop .drop-content > li hr {
  margin: 5px 0;
  width: 70%;
  border-color: #e2e2e2;
}
 .dropdown-menu.notify-drop .drop-content .pd-l0 {
  padding-left: 0;
}
 .dropdown-menu.notify-drop .drop-content > li p {
  font-size: 11px;
  color: #666;
  font-weight: normal;
  margin: 3px 0;
}
.dropdown-menu.notify-drop .drop-content > li p.time {
  font-size: 10px;
  font-weight: 600;
  top: -6px;
  margin: 8px 0px 0px 0px;
  padding: 0px 3px;
  border: 1px solid #e2e2e2;
  position: relative;
  background-image: linear-gradient(#fff,#f2f2f2);
  display: inline-block;
  border-radius: 2px;
  color: #B97745;
}
.dropdown-menu.notify-drop .drop-content > li p.time:hover {
  background-image: linear-gradient(#fff,#fff);
}
.dropdown-menu.notify-drop .notify-drop-footer {
  border-top: 1px solid #e2e2e2;
  bottom: 0;
  position: relative;
  padding: 8px 15px;
}
.dropdown-menu.notify-drop .notify-drop-footer a {
  color: #777;
  text-decoration: none;
}
.dropdown-menu.notify-drop .notify-drop-footer a:hover {
  color: #333;
}

@keyframes example {
  0% {background-color: rgb(0, 0, 0);}
  50% {background-color: rgb(214, 0, 0);}
  100% {background-color: rgb(241, 8, 8);}

}

.notification .badge {

  border-radius: 50%;
  background: red;
  color: white;
  animation-name: example;
  animation-duration: 1s;
  animation-iteration-count: infinite;
  transition: 0.1s;
}


#noti-drop-content text-noti {
  font-size: 25px;
}
</style>
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo $_SERVER ?>clinica/inicio" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C C</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CLINICA CECIP</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <?php

if ($_SESSION["foto"] == "") {
    echo '<img src="' . $_SERVER . 'clinica/Vistas/img/defecto.png" class="user-image" alt="User Image">';
} else {
    echo '<img src=' . $_SERVER . 'clinica/' . $_SESSION["foto"] . ' class="user-image" alt="User Image">';
}
?>
              <span class="hidden-xs"><?php echo $_SESSION["nombre"];
echo " ";
echo $_SESSION["apellido"]; ?></span>

            </a>
            <ul class="dropdown-menu">
              <li class="user-footer">
                <div class="pull-left">
                  <?php

echo '<a href="' . $_SERVER . 'clinica/perfil-' . $_SESSION["rol"] . '" class="btn btn-primary btn-flat">Perfil</a>';
?>
                </div>
                <div class="pull-right">
                  <a href="<?php echo $_SERVER ?>clinica/salir" class="btn btn-danger btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" aria-haspopup="true" aria-expanded="false" role="button" data-toggle="dropdown" class="notification dropdown-toggle">
  <span>Notificaciones</span>
  <span class="contador_noti"></span>
</a>
          <ul  class="dropdown-menu notify-drop">
            <div class="notify-drop-title">
            	<div class="row">
            		<div class="col-md-6 col-sm-6 col-xs-6">Nuevas (<b class="contador_noti">0</b>)</div>
            	</div>
            </div>
            <div id="noti-drop-content" class="drop-content">
            </div>
          </ul>
        </li>
      </ul>
    </nav>
  </header>

  <script>
    var numNotifica = 0;
    async function buscarNotificacion() {

  const formDara = new FormData();
  formDara.append('id_user', <?php echo $_SESSION["id"] ?>);
  formDara.append('tabla', '<?php echo $_SESSION["rol"] ?>');

  $.ajax({
    url: "<?php echo $_SERVER ?>clinica/Ajax/pacientesA.php",
    method: "POST",
    data: formDara,
    cache: false,
    contentType: false,
    processData: false,
    success: function (resultado) {
      var noti =JSON.parse(resultado);
      if(numNotifica == 0){
        numNotifica = noti.length;
        if(noti.length > 0){
          $(".contador_noti").addClass("badge"); 
        }else{
          $(".contador_noti").removeClass("badge"); 
        }
        $(".contador_noti").empty();
        $(".contador_noti").append(noti.length);

        cambiarVista(noti);
      }else{
        if(numNotifica != noti.length){
          $(".contador_noti").addClass("badge"); 
          cambiarVista(noti);
        numNotifica = noti.length;
        $(".contador_noti").empty();
        $(".contador_noti").append(noti.length);
        }
      }
    }

  });
}

setInterval('buscarNotificacion()',500);

function cambiarVista(data){
  let html ='';
$("#noti-drop-content").empty();

  data.map(i => {
    var apend = `<li><div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div><div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a class="text-noti" onclick="cambiarLeido(${i.id})" href="<?php echo $_SERVER; ?>clinica/pacientes">`;
      apend += i.mensaje;
      apend += `</a> <a  onclick="cambiarLeido(${i.id})"  class="rIcon"><i class="fa fa-eye"></i></a><hr><p class="time">`;
      apend += moment(i.datetime).fromNow();
      apend += '</p></div></li>';
      html += apend;
  });
$("#noti-drop-content").append(html);

}
function cambiarLeido(id){
  const formDara = new FormData();
  formDara.append('id_noti', id);

  $.ajax({
    url: "<?php echo $_SERVER ?>clinica/Ajax/pacientesA.php",
    method: "POST",
    data: formDara,
    cache: false,
    contentType: false,
    processData: false,
    success: function (resultado) {
      if(resultado == "true"){
        buscarNotificacion();
      }
    }
  });
}

  </script>