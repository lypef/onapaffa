<?php
  //error_reporting(0);
  session_start();
  if (isset($_SESSION['usuario'])){}else{echo '<script>location.href = "index.php"</script>';}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="metro/favicon.ico" type="image/x-icon">
    <link rel="icon" href="metro/favicon.ico" type="image/x-icon">

    <link href="metro/css/metro-all.css" rel="stylesheet">
    <link href="metro/style.css" rel="stylesheet">

    <title>ONAPAFFA</title>
</head>
<body>
<!-- Menu -->
<nav data-role="ribbonmenu">
  <ul class="tabs-holder">
      <li class="static"><a href="func/logout.php">SALIR</a></li>
      <li class="static"><a href="manager.php">HOME</a></li>
      <li><a href="#section-usuarios">Usuarios</a></li>
  </ul>

  <div class="content-holder">
      <div class="section" id="section-usuarios">
        <!-- Inicia modulo Reportes-->
        <div class="group">
          <div class="ribbon-split-button">
              <button class="ribbon-main">
                  <span class="icon ribbon-main">
                      <span class="mif-file-pdf"></span>
                  </span>
              </button>
              <span class="ribbon-split dropdown-toggle">Generar</span>
              <ul class="ribbon-dropdown" data-role="dropdown" data-duration="100">
                  <li class="checked"><a href="#">Modification</a></li>
                  <li class="checked"><a href="#">Type</a></li>
                  <li class="checked"><a href="#">Size</a></li>
                  <li><a href="#">Creating</a></li>
                  <li><a href="#">Authors</a></li>
                  <li class="checked-one"><a href="#">Tags</a></li>
                  <li><a href="#">Names</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Columns...</a></li>
              </ul>
            </div>
            <span class="title">Opciones</span>
        </div>
        <!-- Finaliza modulo Reportes-->
        <!-- Inicia modulo titulaes-->
        <div class="group">
            <a href="add_titular.php">
            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-plus"></span>
                    </span>
                <span class="caption">Alta titular</span>
            </button></a>

            <a href="gest_titulares.php?pagina=1">
            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-database"></span>
                    </span>
                <span class="caption">Gestionar</span>
            </button>
            </a>

            <a href="gest_titulares.php?pagina=1">
            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-search"></span>
                    </span>
                <span class="caption">Buscar</span>
            </button>
            </a>

            <span class="title">Titulares</span>
        </div>
        <!-- Finaliza modulo titulaes-->

        <!-- Inicia modulo vehiculos-->
        <div class="group">
            <a href="add_vehicle.php">
            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-plus"></span>
                    </span>
                <span class="caption">Alta vehiculo</span>
            </button></a>

            <a href="gest_vehicles.php?pagina=1">
            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-automobile"></span>
                    </span>
                <span class="caption">Gestionar</span>
            </button>
            </a>
            <a href="gest_titulares.php?pagina=1">
            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-search"></span>
                    </span>
                <span class="caption">Buscar</span>
            </button>
            </a>
            <span class="title">Vehiculos</span>
        </div>
        <!-- Finaliza modulo vehiculos-->

        <!-- Inicia modulo Adicionales-->
        <div class="group">
            <a href="gest_adicionales.php?pagina=1">
            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-chart-bars"></span>
                    </span>
                <span class="caption">Gestionar</span>
            </button></a>
            <a href="gest_titulares.php?pagina=1">
            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-search"></span>
                    </span>
                <span class="caption">Buscar</span>
            </button>
            </a>
            <span class="title">Adicionales</span>
        </div>
        <!-- Finaliza modulo Adicionales-->
        <!-- Inicia modulo usuarios-->
        <div class="group">
            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-user-plus"></span>
                    </span>
                <span class="caption">Agregar usuario</span>
            </button>

            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-user-check"></span>
                    </span>
                <span class="caption">Editar usuario</span>
            </button>

            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-users"></span>
                    </span>
                <span class="caption">Gestionar usuarios</span>
            </button>

            <span class="title">Usuarios</span>
        </div>
        <!-- Finaliza modulo usuarios-->

        <!-- Inicia modulo perfil-->
        <div class="group">

             <div data-role="buttonsGroup" data-cls-active="active">
                 <button class="ribbon-button">
                     <span class="icon">
                         <span class="mif-file-upload"></span>
                     </span>
                     <span class="caption">Actualizar</span>
                 </button>
                 <button class="ribbon-button">
                     <span class="icon">
                         <span class="mif-chart-pie"></span>
                     </span>
                     <span class="caption">Mis altas</span>
                 </button>
                 <button class="ribbon-button">
                     <span class="icon">
                         <span class="mif-file-text"></span>
                     </span>
                     <span class="caption">Mis registros</span>
                 </button>
             </div>

             <span class="title">Perfil</span>
           </div>
        </div>
        <!-- Finaliza modulo perfil-->
      </div>
  </div>
</nav>
<!-- Finaliza Menu -->
<div  style="background-color: #dcdcdc; width:100%;">
<div class="container">
