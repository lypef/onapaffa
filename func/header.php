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
      <li class="static"><a href="func/logout.php"><span class="mif-cross"></span> SALIR</a></li>
      <li class="static"><a href="manager.php"><span class="mif-home"></span> <? echo $_SESSION['usuario_name']; ?></a></li>
      <li><a href="#section-usuarios">Usuarios</a></li>
  </ul>

  <div class="content-holder">
      <div class="section" id="section-usuarios">
        <!-- Inicia modulo Reportes-->
        <? if ($_SESSION['gen_reports'] != 0)
        {?>

        <div class="group">
          <div class="ribbon-split-button">
              <button class="ribbon-main">
                  <span class="icon ribbon-main">
                      <span class="mif-file-pdf"></span>
                  </span>
              </button>
              <span class="ribbon-split dropdown-toggle">Generar</span>
              <ul class="ribbon-dropdown" data-role="dropdown" data-duration="100">
                  <li><a href="#">Reportes titulares</a></li>
                  <li><a href="#">Reportes vehiculos</a></li>
                  <li><a href="#">Reportes adicionales</a></li>
                  <li><a href="#">Engomados vencidos</a></li>
                  <li><a href="#">Engomados por vencer</a></li>
              </ul>
            </div>
            <span class="title">Opciones</span>
        </div>
        <?}?>

        <!-- Finaliza modulo Reportes-->

        <!-- Inicia modulo titulaes-->
        <div class="group">
            <? if ($_SESSION['add_titular'] != 0)
            {?>
            <a href="add_titular.php">
            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-plus"></span>
                    </span>
                <span class="caption">Alta titular</span>
            </button></a>
            <?}?>

            <a href="gest_titulares.php?pagina=1">
            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-database"></span>
                    </span>
                <span class="caption">Gestionar</span>
            </button>
            </a>

            <button onclick="search_titular()" class="ribbon-button">
                    <span class="icon">
                        <span class="mif-search"></span>
                    </span>
                <span class="caption">Buscar</span>
            </button>
            <span class="title">Titulares</span>

        </div>
        <!-- Finaliza modulo titulaes-->

        <!-- Inicia modulo vehiculos-->
        <div class="group">
            <? if ($_SESSION['add_vehicle'] != 0)
            {?>
            <a href="select_titular_addvehicle.php?pagina=1">
            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-plus"></span>
                    </span>
                <span class="caption">Alta vehiculo</span>
            </button></a>
            <?}?>

            <a href="gest_vehicles.php?pagina=1">
            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-automobile"></span>
                    </span>
                <span class="caption">Gestionar</span>
            </button>
            </a>

            <button onclick="search_vehiculos()" class="ribbon-button">
                    <span class="icon">
                        <span class="mif-search"></span>
                    </span>
                <span class="caption">Buscar</span>
            </button>

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

            <button onclick="search_adicionales()" class="ribbon-button">
                    <span class="icon">
                        <span class="mif-search"></span>
                    </span>
                <span class="caption">Buscar</span>
            </button>

            <span class="title">Adicionales</span>
        </div>
        <!-- Finaliza modulo Adicionales-->
        <!-- Inicia modulo usuarios-->
        <? if ($_SESSION['crud_users'] != 0){?>
        <div class="group">
            <a href="add_users.php">
            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-user-plus"></span>
                    </span>
                <span class="caption">Agregar usuario</span>
            </button>
            </a>

            <a href="gest_users.php">
            <button class="ribbon-button">
                    <span class="icon">
                        <span class="mif-users"></span>
                    </span>
                <span class="caption">Gestionar usuarios</span>
            </button>
            </a>

            <span class="title">Usuarios</span>
        </div>
        <?}?>
        <!-- Finaliza modulo usuarios-->

        <!-- Inicia modulo perfil-->
        <div class="group">

             <div data-role="buttonsGroup" data-cls-active="active">
                 <button onclick="update_profile()" class="ribbon-button">
                     <span class="icon">
                         <span class="mif-file-upload"></span>
                     </span>
                     <span class="caption">Actualizar</span>
                 </button>
                 <a href="my_highs.php?pagina=1">
                 <button class="ribbon-button">
                     <span class="icon">
                         <span class="mif-chart-pie"></span>
                     </span>
                     <span class="caption">Mis altas</span>
                 </button>
                </a>

                 <a href="my_logs.php?pagina=1">
                 <button class="ribbon-button">
                     <span class="icon">
                         <span class="mif-file-text"></span>
                     </span>
                     <span class="caption">Mis registros</span>
                 </button>
                 </a>

             </div>

             <span class="title">Perfil</span>
           </div>
        </div>
        <!-- Finaliza modulo perfil-->
      </div>
  </div>
</nav>
<?
echo
"
<script>
function update_profile(){
    Metro.dialog.create({
        title: '<p>',
        content: '<div>'
        +'<form  action=func/edit_profile_action.php method=POST name=update_profile>'
            +'<input  type=text name=id id=id value=".'"'.$_SESSION['usuario'].'"'." hidden>'
            +'<input  value=".'"'.$_SESSION['usuario_name'].'"'." id=name name=name type=text  data-role=input data-prepend=".'Nombre'." placeholder=Text >'
            +'<input  id=password name=password type=password  data-role=input data-prepend=".'"Nueva contraseña"'." placeholder=****** >'
            +'<input  id=password_confirm name=password_confirm type=password  data-role=input data-prepend=".'"Repita contraseña"'." placeholder=****** >'
            +'<input type=submit hidden>'
        +'</form></div>',
        actions: [
            {
                caption: '<span class=mif-floppy-disk></span> Guardar',
                cls: 'js-dialog-close info',
                onclick: function(){
                    document.update_profile.submit()
                }
            },
            {
                caption: '<span class=mif-cross></span>',
                cls: 'js-dialog-close'
            }
        ]
    });
}

function search_titular(){
    Metro.dialog.create({
        title: '<p>',
        content: '<div>'
        +'<form  action=gest_titulares.php method=GET >'
            +'<input  type=text name=pagina id=pagina value=1 hidden>'
            +'<input  id=search name=search type=text  data-role=input data-prepend=".'"<span class=mif-search></span>"'." placeholder=Text autofocus>'
            +'<input type=submit hidden>'
        +'</form></div>',
        actions: [
            {
                caption: '<span class=mif-checkmark></span> Buscar',
                cls: 'js-dialog-close info',
                onclick: function(){
                    document.search_titular.submit()
                }
            },
            {
                caption: '<span class=mif-cross></span>',
                cls: 'js-dialog-close'
            }
        ]
    });
}

function search_vehiculos(){
    Metro.dialog.create({
        title: '<p>',
        content: '<div>'
        +'<form  action=gest_vehicles.php method=GET >'
            +'<input  type=text name=pagina id=pagina value=1 hidden>'
            +'<input  id=search_a name=search type=text  data-role=input data-prepend=".'"<span class=mif-search></span>"'." placeholder=Text autofocus>'
            +'<input type=submit hidden>'
        +'</form></div>',
        actions: [
            {
                caption: '<span class=mif-checkmark></span> Buscar',
                cls: 'js-dialog-close info',
                onclick: function(){
                    document.search_vehiculos.submit()
                }
            },
            {
                caption: '<span class=mif-cross></span>',
                cls: 'js-dialog-close'
            }
        ]
    });
}

function search_adicionales(){
    Metro.dialog.create({
        title: '<p>',
        content: '<div>'
        +'<form  action=gest_adicionales.php method=GET >'
            +'<input  type=text name=pagina id=pagina value=1 hidden>'
            +'<input  id=search name=search type=text  data-role=input data-prepend=".'"<span class=mif-search></span>"'." placeholder=Text autofocus>'
            +'<input type=submit hidden>'
        +'</form></div>',
        actions: [
            {
                caption: '<span class=mif-checkmark></span> Buscar',
                cls: 'js-dialog-close info',
                onclick: function(){
                    document.search_adicionales.submit()
                }
            },
            {
                caption: '<span class=mif-cross></span>',
                cls: 'js-dialog-close'
            }
        ]
    });
}

</script>
";
?>
<!-- Finaliza Menu -->
<div  style="background-color: #dcdcdc; width:100%;">
<div class="container">
