<? include 'func/header.php' ?>
<? require_once 'func/db.php' ?>
<br>
<div style="background-color: white;">
<br>
<center>
  <div style="width: 98%;">

    <form action="gest_vehicles.php">
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
        <th>Titular</th>
        <th>Engomado</th>
        <th>Vencimiento</th>
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
      $sql = "SELECT v.id FROM vehiculos v INNER JOIN titulares t ON v.titular = t.id WHERE t.nombre LIKE '%".$txt_buscar."%' or v.serie LIKE '%".$txt_buscar."%' or v.modelo LIKE '%".$txt_buscar."%' or v.marca LIKE '%".$txt_buscar."%' or v.engomado LIKE '%".$txt_buscar."%'  ORDER BY v.id ";
    }
    elseif (isset($_GET["titular"]))
    {
        $titular = $_GET["titular"];
        $sql = "SELECT v.id FROM vehiculos v INNER JOIN titulares t ON v.titular = t.id where t.id =  $titular ";
    }
    else {
      $sql = "SELECT v.id FROM vehiculos v INNER JOIN titulares t ON v.titular = t.id ORDER BY v.id ";
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
      $sql = "SELECT v.id, t.nombre, v.serie, v.tipo, v.modelo, v.marca, v.cilindros, v.color, v.engomado, v.f_expedicion, v.f_vencimiento, REPLACE(REPLACE(v.estatus, 0, 'VENCIDO'), 1, 'VIGENTE'), v.foto, t.id, s.nombre FROM vehiculos v, titulares t, sucursales s where v.titular = t.id and v.sucursal = s.id and t.nombre LIKE '%".$txt_buscar."%' or v.titular = t.id and v.sucursal = s.id and v.serie LIKE '%".$txt_buscar."%' or v.titular = t.id and v.sucursal = s.id and v.modelo LIKE '%".$txt_buscar."%' or v.titular = t.id and v.sucursal = s.id and v.marca LIKE '%".$txt_buscar."%' or v.titular = t.id and v.sucursal = s.id and v.engomado LIKE '%".$txt_buscar."%' or v.titular = t.id and v.sucursal = s.id and t.nombre LIKE '%".$txt_buscar."%' ORDER BY v.id";
    }
    elseif (isset($_GET["titular"]))
    {
        $titular = $_GET["titular"];
        $sql = "SELECT v.id, t.nombre, v.serie, v.tipo, v.modelo, v.marca, v.cilindros, v.color, v.engomado, v.f_expedicion, v.f_vencimiento, REPLACE(REPLACE(v.estatus, 0, 'VENCIDO'), 1, 'VIGENTE'), v.foto, t.id, s.nombre FROM vehiculos v, titulares t, sucursales s where v.titular = t.id and v.sucursal = s.id and t.id =  $titular ";
    }
    else {
      $sql = "SELECT v.id, t.nombre, v.serie, v.tipo, v.modelo, v.marca, v.cilindros, v.color, v.engomado, v.f_expedicion, v.f_vencimiento, REPLACE(REPLACE(v.estatus, 0, 'VENCIDO'), 1, 'VIGENTE'), v.foto, t.id, s.nombre FROM vehiculos v, titulares t, sucursales s where v.titular = t.id and v.sucursal = s.id ORDER BY v.id desc LIMIT $inicio, $TAMANO_PAGINA";
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
        <td>".$row[0]."</td>
        <td>".'<img class= "round100" src="'.$row[12].'">'."</td>
        <td>".$row[1]."</td>
        <td>".$row[8]."</td>
        <td>".$row[10]."</td>
        <td>".$row[11]."</td>
        <td>".
        '<div class="split-button">
          <button class="button" onclick="Metro.dialog.open('."'#".$row[0]."'".')" ><span class="mif-eye"></span> Detalles</button>
          <button class="split dropdown-toggle"></button>
          <ul class="d-menu" data-role="dropdown">
              <li><a onclick="'."renovar".$row[0]."()".'"><span class="mif-loop2"></span> Renovar</a></li>
              <li class="divider"></li>
              <li><a onclick="'."adicional".$row[0]."()".'"><span class="mif-plus"></span> Nuevo adicional</a></li>
              <li><a href="gest_adicionales.php?pagina=1&vehicle='.$row[0].'"><span class="mif-eye"></span> Ver adicionales</a></li>
              <li class="divider"></li>
              <li><a onclick="'."edit".$row[0]."()".'"><span class="mif-pencil"></span> Editar vehiculo</a></li>
              <li><a onclick="'."delete".$row[0]."()".'"><span class="mif-bin"></span> Eliminar vehiculo</a></li>
          </ul>
      </div>

      '
        ."</td>

        <script>
        function renovar".$row[0]."(){
            Metro.dialog.create({
                title: '".'<center><img class= "round100" src="'.$row[12].'"></center>'."',
                content: '<div><center>RENOVAR ENGOMADO</center><br>'
                  +'<form  action=func/vehicle_update_engomado.php method=POST enctype=multipart/form-data name=".'"editform'.$row[0].'"'." >'
                      +'<input value=".'"'.$row[0].'"'." type=hidden name=id id=id>'
                      +'<label>Fecha de inicio</label>'
                      +'<input id=f_expedicion name=f_expedicion data-role=calendarpicker  placeholder=Fecha expedicion required value=".'"'.$row[9].'"'.">'
                      +'<br><label>Fecha de termino</label>'
                      +'<input id=f_vencimiento name=f_vencimiento data-role=calendarpicker  placeholder=Fecha de vencimiento required value=".'"'.$row[10].'"'.">'
                      +'<input type=submit hidden>'
                  +'</form></div>',
                actions: [
                    {
                        caption: '<span class=mif-floppy-disk></span> Renovar',
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

        function adicional".$row[0]."(){
              Metro.dialog.create({
                  title: '".'<center><img class= "round100" src="'.$row[12].'"></center>'."',
                  content: '<div><center>AGREGAR ADICIONAL</center><br>'
                    +'<form  action=func/add_adicional_vehicle_action.php method=POST enctype=multipart/form-data name=".'"adicional'.$row[0].'"'." >'
                        +'<select  name=sucursal id=sucursal required>'
                        +'<option value=>SELECCIONE SUCURSAL</option>'
                        +'".$body_suc."'
                        +'</select>'
                        +'<input value=".'"'.$row[0].'"'." type=hidden name=vehiculo id=vehiculo>'
                        +'<input value=".'"'.$row[13].'"'." type=hidden name=titular id=titular>'
                        +'<input id=nombre name=nombre type=text data-role=input data-prepend=Nombre: placeholder=".'"Nombre de adicional"'." required>'
                        +'<input id=domicilio name=domicilio type=text data-role=input data-prepend=Domicilio: placeholder=".'"Domicilio de adicional"'." >'
                        +'<input id=cp name=cp type=text data-role=input data-prepend=CP: placeholder=".'"Codigo postal"'." >'
                        +'<input id=telefono name=telefono type=text data-role=input data-prepend=Telefono: placeholder=".'"Telefono | celular"'." >'
                        +'<input id=foto name=foto type=file data-role=file placeholder=Buscar fotografia class=mt-2 accept=image/jpeg,image/jpg>'
                        +'<input type=submit hidden>'
                    +'</form></div>',
                  actions: [
                      {
                          caption: '<span class=mif-floppy-disk></span> Guardar',
                          cls: 'js-dialog-close success',
                          onclick: function(){
                              document.adicional".$row[0].".submit()
                          }
                      },
                      {
                          caption: '<span class=mif-checkmark></span> Cancelar',
                          cls: 'js-dialog-close'
                      }
                  ]
              });
          }

          function edit".$row[0]."(){
              Metro.dialog.create({
                  title: '".'<center><img class= "round100" src="'.$row[12].'"></center>'."',
                  content: '<div><center>EDITAR VEHICULO</center><br><br>SUCURSAL ACTUAL: ".$row[14]."'
                    +'<form  action=func/edit_vehicle_action.php method=POST enctype=multipart/form-data name=".'"editform'.$row[0].'"'." >'
                        +'<input value=".'"'.$row[0].'"'." type=hidden name=id id=id>'
                        +'<select  name=sucursal id=sucursal>'
                        +'<option value=>SELECCIONE SUCURSAL SI DESEA CAMBIAR</option>'
                        +'".$body_suc."'
                        +'</select>'
                        +'<input value=".'"'.$row[2].'"'." id=serie name=serie type=text data-role=input data-prepend=Serie: placeholder=".'"Serie del vehiculo"'." required>'
                        +'<input value=".'"'.$row[3].'"'." id=tipo name=tipo type=text data-role=input data-prepend=Tipo: placeholder=".'"Tipo de vehiculo"'." required>'
                        +'<input value=".'"'.$row[4].'"'." id=modelo name=modelo type=text data-role=input data-prepend=Modelo: placeholder=".'"Modelo del vehiculo"'." required>'
                        +'<input value=".'"'.$row[5].'"'." id=marca name=marca type=text data-role=input data-prepend=Marca: placeholder=".'"Marca del vehiculo"'." required>'
                        +'<input value=".'"'.$row[6].'"'." id=cilindros name=cilindros type=text data-role=input data-prepend=Cilindros: placeholder=".'"Numero de cilindros"'." required>'
                        +'<input value=".'"'.$row[7].'"'." id=color name=color type=text data-role=input data-prepend=Color: placeholder=".'"Color de vehiculo"'." required>'
                        +'<input value=".'"'.$row[8].'"'." id=engomado name=engomado type=text data-role=input data-prepend=Engomado: placeholder=".'"Engomado de vehiculo"'." required>'
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
                  title: '".'<center><img class= "round100" src="'.$row[12].'"></center>'."',
                  content: '<div>¿EN REALIDAD QUIERE ELIMINAR EL VEHICULO, DESPUES DE ELIMINARLO ES IMPOSIBLE RECUPERARLO?'
                    +'<form  action=func/delete_vehile_action.php method=POST name=".'"delete'.$row[0].'"'." >'
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
            <div class='dialog-title'>".'<center><img class= "round100" src="'.$row[12].'"></center>'."</div>
            <div class='dialog-content'>
                TITULAR: ".$row[1]."
                <br><br>SERIE: ".$row[2]."
                <br>TIPO: ".$row[3]."
                <br>MODELO: ".$row[4]."
                <br>MARCA: ".$row[5]."
                <br>CILINDROS: ".$row[6]."
                <br>COLOR: ".$row[7]."
                <br>ENGOMADO: ".$row[8]."
                <br>FECHA DE INICIO: ".$row[9]."
                <br>FECHA DE VENCIMIENTO: ".$row[10]."
                <br>ESTATUS: ".$row[11]."
                <br>SUCURSAL: ".$row[14]."
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
        echo '<li class="page-item service"><a class="page-link" href="gest_vehicles.php?pagina='.($pagina - 1 ).'"><span class="mif-arrow-left"></span></a></li>';
    }else {
        echo '<li class="page-item service"><a class="page-link" ><span class="mif-arrow-left"></span></a></li>';
    }

    if ($total_paginas > 1) {
      for ($i=1;$i<=$total_paginas;$i++) {
         if ($pagina == $i)
            echo '<li class="page-item active"><a class="page-link" >'.$i.'</a></li>';
         else
            echo '<li class="page-item"><a class="page-link" href="gest_vehicles.php?pagina='.$i.'">'.$i.'</a></li>';

      }
    }
    if ($pagina < $total_paginas)
    {
        echo '<li class="page-item service"><a class="page-link" href="gest_vehicles.php?pagina='.($pagina + 1 ).'"><span class="mif-arrow-right"></span></a></li>';
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
          Metro.notify.create("Vehiculo actualizado", "<span class='mif-checkmark'></span> Actualizado", {cls: "success"});
      }

      if (noupdate)
      {
          Metro.notify.create("Vehiculo no actualizado", "<span class='mif-cross'></span> No actualizado", {cls: "alert"});
      }

      if (getUrlVars()["delete"])
      {
          Metro.notify.create("Vehiculo eliminado con exito", "<span class='mif-checkmark'></span> Eliminado", {cls: "success"});
      }

      if (getUrlVars()["nodelete"])
      {
          Metro.notify.create("Vehiculo NO eliminado", "<span class='mif-cross'></span> No eliminado", {cls: "alert"});
      }

      if (getUrlVars()["success"])
      {
          Metro.notify.create("Adicional agregado", "<span class='mif-checkmark'></span> Agregado", {cls: "success"});
      }

      if (getUrlVars()["error_image"])
      {
          Metro.notify.create("Adicional NO agregado", "<span class='mif-cross'></span> No agregado", {cls: "alert"});
      }

      if (getUrlVars()["error"])
      {
          Metro.notify.create("Adicional NO agregado", "<span class='mif-cross'></span> No agregado", {cls: "alert"});
      }

      if (getUrlVars()["adicionalno"])
      {
          Metro.notify.create("El numero de adicionales permitidos se ah excedido", "<span class='mif-cross'></span> Excedido", {cls: "warning"});
      }

      if (getUrlVars()["noengomado"])
      {
          Metro.notify.create("No se actualizo el periodo", "<span class='mif-cross'></span> Excedido", {cls: "alert"});
      }

      if (getUrlVars()["engomado"])
      {
          Metro.notify.create("Periodo actualizado", "<span class='mif-checkmark'></span> Excedido", {cls: "success"});
      }

      function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
        });
        return vars;
      }

  </script>
