<? include 'func/header.php' ?>
<? require_once 'func/db.php' ?>
<br>
<div style="background-color: white;">
<br>
<center>
  <div style="width: 98%;">

    <form action="gest_titulares.php">
        <input type="text" name="pagina" value="1" hidden>
        <input type="text" placeholder="Buscar" name="search">
        <input type=submit hidden>
    </form>

  </div>
</center>
<hr>
<table class="table striped">
    <thead>
    <tr>
        <th>No.</th>
        <th>Fotografia</th>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?
    if (isset($_GET["search"]))
    {
        $txt_buscar = str_replace(","," ",$_GET["search"]);
    }

    $conn = mysqli_connect($host,$user,$password,$db);
    $sql = "SELECT * FROM titulares";
    $result = mysqli_query($conn,$sql) ;
    //Paginacion
    $num_total_registros = mysqli_num_rows($result);

    //Limito la busqueda
    if (isset($txt_buscar))
    {
      $TAMANO_PAGINA = 100;
    }else {
      $TAMANO_PAGINA = 5;
    }

    //examino la página a mostrar y el inicio del registro a mostrar
    $pagina = $_GET["pagina"];
    if (!$pagina) {
       $inicio = 0;
       $pagina = 1;
    }
    else {
       $inicio = ($pagina - 1) * $TAMANO_PAGINA;
    }
    //calculo el total de páginas
    $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

    if (isset($_GET["search"]))
    {
      $sql = "SELECT t.id, t.nombre, t.domicilio, t.cp, t.telefono, t.fotografia, t.atendio, s.nombre FROM titulares t INNER JOIN sucursales s ON t.sucursal = s.id WHERE t.nombre LIKE '%".$txt_buscar."%' ORDER BY t.nombre ASC LIMIT ".$inicio.",". "$TAMANO_PAGINA";
    }else {
      $sql = "SELECT t.id, t.nombre, t.domicilio, t.cp, t.telefono, t.fotografia, t.atendio, s.nombre FROM titulares t INNER JOIN sucursales s ON t.sucursal = s.id ORDER BY t.nombre ASC LIMIT ".$inicio.",". "$TAMANO_PAGINA";
    }
    $result = mysqli_query($conn,$sql);

    $sucursales_sql = "SELECT * FROM sucursales";
    $sucursales = mysqli_query($conn,$sucursales_sql);
    $body_suc = "";
    while($r = mysqli_fetch_array($sucursales))
    {
      $body_suc = $body_suc."<option value = $r[0] >$r[1]</option>";
    }

    while($row = mysqli_fetch_array($result)){
    echo "
    <tr>
        <td>".$row[0]."</td>
        <td>".'<img class= "round100" src="'.$row[5].'">'."</td>
        <td>".$row[1]."</td>
        <td>".$row[4]."</td>
        <td>".
        '<div class="split-button">
          <button class="button" onclick="Metro.dialog.open('."'#".$row[0]."'".')" ><span class="mif-eye"></span> Detalles</button>
          <button class="split dropdown-toggle"></button>
          <ul class="d-menu" data-role="dropdown">
              <li><a href="gest_vehicles.php?pagina=1&titular='.$row[0].'"><span class="mif-automobile"></span> Ver vehiculos</a></li>
              <li class="divider"></li>
              <li><a '.(($_SESSION['edit_titular'] == 0)?' hidden':"").' onclick="'."edit".$row[0]."()".'"><span class="mif-pencil"></span> Editar</a></li>
              <li><a '.(($_SESSION['delete_titular'] == 0)?' hidden':"").' onclick="'."delete".$row[0]."()".'"><span class="mif-bin"></span> Eliminar</a></li>
          </ul>
      </div>

      '
        ."</td>

        <script>

        function edit".$row[0]."(){
              Metro.dialog.create({
                  title: '".'<center><img class= "round100" src="'.$row[5].'"></center>'."',
                  content: '<div><center>EDITAR TITULAR: ".$row[1]."</center><br>SUCURSAL ACTUAL: ".$row[7]."'
                    +'<form  action=func/edit_titular_action.php method=POST enctype=multipart/form-data name=".'"editform'.$row[0].'"'." >'
                        +'<input value=".'"'.$row[0].'"'." type=hidden name=id id=id>'
                        +'<select  name=sucursal id=sucursal>'
                        +'<option value=>SELECCIONE SUCURSAL SI DESEA CAMBIAR</option>'
                        +'".$body_suc."'
                        +'</select>'
                        +'<input value=".'"'.$row[1].'"'." id=_nombre name=_nombre type=text data-role=input data-prepend=Nombre placeholder=Escriba nombre completo required>'
                        +'<input value=".'"'.$row[2].'"'." id=domicilio name=domicilio type=text data-role=input data-prepend=Domicilio placeholder=Domicilio del titular >'
                        +'<input value=".'"'.$row[3].'"'." id=cp name=cp type=text data-role=input data-prepend=Codigo posta placeholder=Codigo postal >'
                        +'<input value=".'"'.$row[4].'"'." id=telefono name=telefono type=text data-role=input data-prepend=Telefono placeholder=Ingrese Telefono >'
                        +'<input value=".'"'.$row[5].'"'." type=hidden name=_foto id=_foto>'
                        +'<input id=foto name=foto type=file data-role=file placeholder=Buscar fotografia class=mt-2 accept=image/jpeg,image/jpg>'
                        +'<input type=submit hidden>'
                    +'</form></div>',
                  actions: [
                      {
                          caption: '<span class=mif-floppy-disk></span> Guardar',
                          cls: 'js-dialog-close success',
                          onclick: function(){
                              document.editform".$row[0].".submit()
                          }
                      },
                      {
                          caption: '<span class=mif-checkmark></span> Cancelar',
                          cls: 'js-dialog-close'
                      }
                  ]
              });
          }

          function delete".$row[0]."(){
              Metro.dialog.create({
                  title: '".'<center><img class= "round100" src="'.$row[5].'"></center>'."',
                  content: '<div>SE ELIMINARA EL TITULAR: ".$row[1].", TODOS SUS VEHICULOS Y TITULARES.'
                    +'<form  action=func/delete_titular_action.php method=POST name=".'"delete'.$row[0].'"'." >'
                        +'<input value=".'"'.$row[0].'"'." type=hidden name=id id=id>'
                    +'</form></div>',
                  actions: [
                      {
                          caption: '<span class=mif-cross></span> Eliminar',
                          cls: 'js-dialog-close alert',
                          onclick: function(){
                              document.delete".$row[0].".submit()
                          }
                      },
                      {
                          caption: '<span class=mif-checkmark></span> Cancelar',
                          cls: 'js-dialog-close'
                      }
                  ]
              });
            }
        </script>


        <div class='dialog' data-role='dialog' id=".$row[0].">
            <div class='dialog-title'>".'<center><img class= "round100" src="'.$row[5].'"></center>'."
            ".$row[1]."</div>
            <div class='dialog-content'>
                DOMICILIO: ".$row[2].", CP: ".$row[3]."
                <br>TELEFONO: ".$row[4]."
                <br>SUCURSAL: ".$row[7]."
            </div>
            <div class='dialog-actions'>
                <button class='button js-dialog-close info'><span class='mif-checkmark'></span></button>
            </div>
        </div>
      </tr>";
    }
    ?>
    </tbody>
</table>
</div>
<ul class="pagination alert flex-justify-center">
    <?php
    if ($pagina > 1)
    {
        echo '<li class="page-item service"><a class="page-link" href="gest_titulares.php?pagina='.($pagina - 1 ).'"><span class="mif-arrow-left"></span></a></li>';
    }else {
        echo '<li class="page-item service"><a class="page-link" ><span class="mif-arrow-left"></span></a></li>';
    }

    if ($total_paginas > 1) {
      for ($i=1;$i<=$total_paginas;$i++) {
         if ($pagina == $i)
            echo '<li class="page-item active"><a class="page-link" >'.$i.'</a></li>';
         else
            echo '<li class="page-item"><a class="page-link" href="gest_titulares.php?pagina='.$i.'">'.$i.'</a></li>';

      }
    }
    if ($pagina < $total_paginas)
    {
        echo '<li class="page-item service"><a class="page-link" href="gest_titulares.php?pagina='.($pagina + 1 ).'"><span class="mif-arrow-right"></span></a></li>';
    }else {
        echo '<li class="page-item service"><a class="page-link" ><span class="mif-arrow-right"></span></a></li>';
    }
    ?>
</ul>
<?php include 'func/footer.php' ?>
<script>
      //location.href = "href/welcome.php"
      var update = getUrlVars()["update"];
      var noupdate = getUrlVars()["noupdate"];

      if (update)
      {
          Metro.notify.create("Titular actualizado con exito", "<span class='mif-checkmark'></span> Actualizado", {cls: "success"});
      }

      if (noupdate)
      {
          Metro.notify.create("Titular no actualizado", "<span class='mif-cross'></span> No actualizado", {cls: "alert"});
      }

      if (getUrlVars()["delete"])
      {
          Metro.notify.create("Titular eliminado con exito", "<span class='mif-checkmark'></span> Eliminado", {cls: "success"});
      }

      if (getUrlVars()["nodelete"])
      {
          Metro.notify.create("Titular NO eliminado", "<span class='mif-cross'></span> No eliminado", {cls: "alert"});
      }

      function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
        });
        return vars;
      }

  </script>
