<? include 'func/header.php' ?>
<? require_once 'func/db.php' ?>
<br>
<div style="background-color: white;">
<br>
<center>
  <div style="width: 98%;">
    <form >
        <input type="text" data-role="search" placeholder="Buscar">
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
    $conn = mysqli_connect($host,$user,$password,$db);
    $sql = "SELECT * FROM titulares";
    $result = mysqli_query($conn,$sql) ;
    //Paginacion
    $num_total_registros = mysqli_num_rows($result);

    //Limito la busqueda
    $TAMANO_PAGINA = 5;

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

    $sql = "SELECT *, REPLACE(REPLACE(estatus, 0, 'VENCIDO'), 1, 'VIGENTE') FROM `titulares` ORDER BY nombre ASC LIMIT ".$inicio.",". "$TAMANO_PAGINA";
    $result = mysqli_query($conn,$sql);

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
              <li><a href="#"><span class="mif-plus"></span> Agregar vehiculo</a></li>
              <li><a href="#"><span class="mif-automobile"></span> Ver vehiculos</a></li>
              <li class="divider"></li>
              <li><a onclick="'."edit".$row[0]."()".'"><span class="mif-pencil"></span> Editar</a></li>
              <li><a onclick="'."delete".$row[0]."()".'"><span class="mif-bin"></span> Eliminar</a></li>
          </ul>
      </div>

      '
        ."</td>

        <script>
          function edit".$row[0]."(){
              Metro.dialog.create({
                  title: '".'<img class= "round100" src="'.$row[5].'">'."',
                  content: '<div>ELIMINAR TITULAR: ".$row[1]."<br><br>SE ELIMINARA EL TITULAR Y TODOS SUS VEHICULOS REGISTRADOS.</div>',
                  actions: [
                      {
                          caption: '<span class=mif-floppy-disk></span> Guardar',
                          cls: 'js-dialog-close success',
                          onclick: function(){
                              alert('a CONTINUACION SE ACTUALIZAN EL TITULAR.');
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
                  title: '".'<img class= "round100" src="'.$row[5].'">'."',
                  content: '<div>ELIMINAR TITULAR: ".$row[1]."<br><br>SE ELIMINARA EL TITULAR Y TODOS SUS VEHICULOS REGISTRADOS.</div>',
                  actions: [
                      {
                          caption: '<span class=mif-cross></span> Eliminar',
                          cls: 'js-dialog-close alert',
                          onclick: function(){
                              alert('a CONTINUACION SE ELIMINA EL TITULAR.');
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
                <br>FECHA EXPEDICION: ".$row[6]."
                <br>FECHA EXPIRACION: ".$row[7]."
                <br>ESTATUS: ".$row[9]."
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
