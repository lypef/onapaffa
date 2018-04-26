<? include 'func/header.php' ?>
<? require_once 'func/db.php' ?>
<br>
<div style="background-color: white;">
<br>
<center>
  <div style="width: 98%;">

    <form action="gest_adicionales.php">
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
        <th>Vehiculo</th>
        <th>Titular</th>
        <th>Adicional</th>
        <th>Estatus</th>
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
    if (isset($_GET["search"]))
    {
      $sql = "SELECT a.id from vehiculos v, titulares t, adicionales a where a.titular = t.id and a.vehiculo = v.id and t.nombre LIKE '%".$txt_buscar."%' or a.titular = t.id and a.vehiculo = v.id and a.nombre LIKE '%".$txt_buscar."%' or a.titular = t.id and a.vehiculo = v.id and v.modelo LIKE '%".$txt_buscar."%' or a.titular = t.id and a.vehiculo = v.id and v.marca LIKE '%".$txt_buscar."%' or a.titular = t.id and a.vehiculo = v.id and v.engomado LIKE '%".$txt_buscar."%'  ORDER BY v.id";
    }
    elseif (isset($_GET["vehicle"]))
    {
        $vehicle = $_GET["vehicle"];
        $sql = "SELECT a.id from vehiculos v, titulares t, adicionales a where a.titular = t.id and a.vehiculo = v.id and v.id =  $vehicle ORDER BY v.id ";
    }
    else {
      $sql = "SELECT a.id from vehiculos v, titulares t, adicionales a where a.titular = t.id and a.vehiculo = v.id ";
    }

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
      $sql = "SELECT a.id, v.foto, t.nombre, a.nombre, v.f_vencimiento, REPLACE(REPLACE(v.estatus, 0, 'VENCIDO'), 1, 'VIGENTE'), a.domicilio, a.cp, a.telefono, a.foto, t.fotografia, s.nombre from vehiculos v, titulares t, adicionales a, sucursales s  where a.titular = t.id and a.vehiculo = v.id and a.sucursal = s.id and t.nombre LIKE '%".$txt_buscar."%' or a.titular = t.id and a.vehiculo = v.id and a.sucursal = s.id and a.titular = t.id and a.vehiculo = v.id and a.nombre LIKE '%".$txt_buscar."%' or a.titular = t.id and a.vehiculo = v.id and a.sucursal = s.id and a.titular = t.id and a.vehiculo = v.id and v.modelo LIKE '%".$txt_buscar."%' or a.titular = t.id and a.vehiculo = v.id and a.sucursal = s.id and a.titular = t.id and a.vehiculo = v.id and v.marca LIKE '%".$txt_buscar."%' or a.titular = t.id and a.vehiculo = v.id and a.sucursal = s.id and a.titular = t.id and a.vehiculo = v.id and v.engomado LIKE '%".$txt_buscar."%' ORDER BY v.id";
    }
    elseif (isset($_GET["vehicle"]))
    {
        $vehicle = $_GET["vehicle"];
        $sql = "SELECT a.id, v.foto, t.nombre, a.nombre, v.f_vencimiento, REPLACE(REPLACE(v.estatus, 0, 'VENCIDO'), 1, 'VIGENTE'), a.domicilio, a.cp, a.telefono, a.foto, t.fotografia, s.nombre from vehiculos v, titulares t, adicionales a, sucursales s  where a.titular = t.id and a.vehiculo = v.id and a.sucursal = s.id and v.id =  $vehicle  ORDER BY v.id ";
    }
    else {
      $sql = "SELECT a.id, v.foto, t.nombre, a.nombre, v.f_vencimiento, REPLACE(REPLACE(v.estatus, 0, 'VENCIDO'), 1, 'VIGENTE'), a.domicilio, a.cp, a.telefono, a.foto, t.fotografia, s.nombre from vehiculos v, titulares t, adicionales a, sucursales s  where a.titular = t.id and a.vehiculo = v.id and a.sucursal = s.id ORDER BY v.id desc LIMIT $inicio, $TAMANO_PAGINA";
    }
    $result = mysqli_query($conn,$sql);

    $sql_t = "SELECT * FROM titulares";
    $result_t = mysqli_query($conn,$sql_t);

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
        <td>".'<img class= "round100" src="'.$row[1].'">'."</td>
        <td>".'<img class= "round100" src="'.$row[10].'">'."<br>".$row[2]."</td>
        <td>".'<img class= "round100" src="'.$row[9].'">'." <br>".$row[3]."</td>
        <td>".$row[5]."</td>
        <td>".
        '<div class="split-button">
          <button class="button" onclick="Metro.dialog.open('."'#".$row[0]."'".')" ><span class="mif-eye"></span> Detalles</button>
          <button class="split dropdown-toggle"></button>
          <ul class="d-menu" data-role="dropdown">
              <li><a '.(($_SESSION['edit_adicional'] == 0)?' hidden':"").' onclick="'."edit".$row[0]."()".'"><span class="mif-pencil"></span> Editar adicional</a></li>
              <li><a '.(($_SESSION['delete_adicional'] == 0)?' hidden':"").' onclick="'."delete".$row[0]."()".'"><span class="mif-bin"></span> Eliminar adicional</a></li>
          </ul>
      </div>

      '
        ."</td>

        <script>
          function edit".$row[0]."(){
              Metro.dialog.create({
                  title: '".'<center><img class= "round100" src="'.$row[1].'"></center>'."',
                  content: '<div><center>EDITAR ADICIONAL</center><br><br>SUCURSAL ACTUAL: ".$row[11]."'
                      +'<form  action=func/edit_adicional_action.php method=POST enctype=multipart/form-data name=".'"editform'.$row[0].'"'." >'
                      +'<select  name=sucursal id=sucursal>'
                      +'<option value=>SELECCIONE SUCURSAL SI DESEA CAMBIAR</option>'
                      +'".$body_suc."'
                      +'</select>'
                      +'<input value=".'"'.$row[0].'"'." type=hidden name=adicional id=adicional>'
                      +'<input value=".'"'.$row[3].'"'." id=nombre name=nombre type=text data-role=input data-prepend=Nombre: placeholder=".'"Nombre de adicional"'." required>'
                      +'<input value=".'"'.$row[6].'"'." id=domicilio name=domicilio type=text data-role=input data-prepend=Domicilio: placeholder=".'"Domicilio de adicional"'." >'
                      +'<input value=".'"'.$row[7].'"'." id=cp name=cp type=text data-role=input data-prepend=CP: placeholder=".'"Codigo postal"'." >'
                      +'<input value=".'"'.$row[8].'"'." id=telefono name=telefono type=text data-role=input data-prepend=Telefono: placeholder=".'"Telefono | celular"'." >'
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
                  title: '".'<center><img class= "round100" src="'.$row[1].'"></center>'."',
                  content: '<div><CENTER>¿ELIMINAR ADICIONAL?</CENTER><br> TITULAR: ".'"'.$row[2].'"'."<br> ADICIONAL: ".'"'.$row[3].'"'."'
                    +'<form  action=func/delete_adicional_action.php method=POST name=".'"delete'.$row[0].'"'." >'
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
            <div class='dialog-title'>".'<center><img class= "round100" src="'.$row[1].'"></center>'."</div>
            <div class='dialog-content'>
                ADICIONAL: ".$row[3]."
                <br>SUCURSAL: ".$row[11]."
                <br>DOMICILIO: ".$row[6]."
                <br>CP: ".$row[7]."
                <br>TELEFONO: ".$row[8]."
                <br>VENCIMIENTO: ".$row[4]."
                <br>ESTATUS: ".$row[5]."
                <br><br>TITULAR: ".$row[2]."
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
        echo '<li class="page-item service"><a class="page-link" href="gest_adicionales.php?pagina='.($pagina - 1 ).'"><span class="mif-arrow-left"></span></a></li>';
    }else {
        echo '<li class="page-item service"><a class="page-link" ><span class="mif-arrow-left"></span></a></li>';
    }

    if ($total_paginas > 1) {
      for ($i=1;$i<=$total_paginas;$i++) {
         if ($pagina == $i)
            echo '<li class="page-item active"><a class="page-link" >'.$i.'</a></li>';
         else
            echo '<li class="page-item"><a class="page-link" href="gest_adicionales.php?pagina='.$i.'">'.$i.'</a></li>';

      }
    }
    if ($pagina < $total_paginas)
    {
        echo '<li class="page-item service"><a class="page-link" href="gest_adicionales.php?pagina='.($pagina + 1 ).'"><span class="mif-arrow-right"></span></a></li>';
    }else {
        echo '<li class="page-item service"><a class="page-link" ><span class="mif-arrow-right"></span></a></li>';
    }
    ?>
</ul>
<?php include 'func/footer.php' ?>
<script>
      //location.href = "href/welcome.php"
      if (getUrlVars()["update"])
      {
          Metro.notify.create("Adicional actualizado", "<span class='mif-checkmark'></span> Actualizado", {cls: "success"});
      }

      if (getUrlVars()["noupdate"])
      {
          Metro.notify.create("Adicional no actualizado", "<span class='mif-cross'></span> No actualizado", {cls: "alert"});
      }

      if (getUrlVars()["delete"])
      {
          Metro.notify.create("Adicional eliminado con exito", "<span class='mif-checkmark'></span> Eliminado", {cls: "success"});
      }

      if (getUrlVars()["nodelete"])
      {
          Metro.notify.create("Adicional NO eliminado", "<span class='mif-cross'></span> No eliminado", {cls: "alert"});
      }

      if (getUrlVars()["success"])
      {
          Metro.notify.create("Adicional agregado", "<span class='mif-checkmark'></span> Agregado", {cls: "success"});
      }

      if (getUrlVars()["error_image"])
      {
          Metro.notify.create("Adicionalo NO agregado", "<span class='mif-cross'></span> No agregado", {cls: "alert"});
      }

      if (getUrlVars()["adicionalno"])
      {
          Metro.notify.create("El numero de adicionales permitidos se ah excedido", "<span class='mif-cross'></span> Excedido", {cls: "warning"});
      }

      function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
        });
        return vars;
      }

  </script>
