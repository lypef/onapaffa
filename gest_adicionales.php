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
        <th>Vehiculo</th>
        <th>Titular</th>
        <th>Adicional</th>
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
      $sql = "SELECT v.id, t.nombre, v.serie, v.tipo, v.modelo, v.marca, v.cilindros, v.color, v.engomado, v.f_expedicion, v.f_vencimiento, REPLACE(REPLACE(v.estatus, 0, 'VENCIDO'), 1, 'VIGENTE'), v.foto FROM vehiculos v INNER JOIN titulares t ON v.titular = t.id WHERE t.nombre LIKE '%".$txt_buscar."%' or v.serie LIKE '%".$txt_buscar."%' or v.modelo LIKE '%".$txt_buscar."%' or v.marca LIKE '%".$txt_buscar."%' or v.engomado LIKE '%".$txt_buscar."%'  ORDER BY v.id ";
    }
    elseif (isset($_GET["titular"]))
    {
        $titular = $_GET["titular"];
        $sql = "SELECT v.id, t.nombre, v.serie, v.tipo, v.modelo, v.marca, v.cilindros, v.color, v.engomado, v.f_expedicion, v.f_vencimiento, REPLACE(REPLACE(v.estatus, 0, 'VENCIDO'), 1, 'VIGENTE'), v.foto FROM vehiculos v INNER JOIN titulares t ON v.titular = t.id where t.id =  $titular ";
    }
    else {
      $sql = "SELECT a.id, v.foto, t.nombre, a.nombre, v.f_vencimiento, REPLACE(REPLACE(v.estatus, 0, 'VENCIDO'), 1, 'VIGENTE'), a.domicilio, a.cp, a.telefono, a.foto from vehiculos v, titulares t, adicionales a where a.titular = t.id and a.vehiculo = v.id ORDER BY v.id desc LIMIT $inicio, $TAMANO_PAGINA";
    }
    $result = mysqli_query($conn,$sql);

    $sql_t = "SELECT * FROM titulares";
    $result_t = mysqli_query($conn,$sql_t);


    while($row = mysqli_fetch_array($result)){
    echo "
    <tr>
        <td>".$row[0]."</td>
        <td>".'<img class= "round100" src="'.$row[1].'">'."</td>
        <td>".$row[2]."</td>
        <td>".$row[3]."</td>
        <td>".$row[4]."</td>
        <td>".$row[5]."</td>
        <td>".
        '<div class="split-button">
          <button class="button" onclick="Metro.dialog.open('."'#".$row[0]."'".')" ><span class="mif-eye"></span> Detalles</button>
          <button class="split dropdown-toggle"></button>
          <ul class="d-menu" data-role="dropdown">
              <li><a onclick="'."edit".$row[0]."()".'"><span class="mif-pencil"></span> Editar</a></li>
              <li><a onclick="'."delete".$row[0]."()".'"><span class="mif-bin"></span> Eliminar</a></li>
          </ul>
      </div>

      '
        ."</td>

        <script>
          function edit".$row[0]."(){
              Metro.dialog.create({
                  title: '".'<center><img class= "round100" src="'.$row[9].'"></center>'."',
                  content: '<div><center>EDITAR ADICIONAL</center><br>'
                    +'<form  action=func/edit_vehicle_action.php method=POST enctype=multipart/form-data name=".'"editform'.$row[0].'"'." >'
                        +'<input value=".'"'.$row[0].'"'." type=hidden name=id id=id>'
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
                <br>TITULAR: ".$row[2]."
                <br><br>DOMICILIO: ".$row[6]."
                <br>CP: ".$row[7]."
                <br>TELEFONO: ".$row[8]."
                <br>VENCIMIENTO: ".$row[4]."
                <br>ESTATUS: ".$row[5]."
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
