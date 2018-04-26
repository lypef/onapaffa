<? include 'func/header.php' ?>
<? require_once 'func/db.php' ?>
<br>
<div style="background-color: white;">
<br>
<table class="table striped">
    <thead>
    <tr>
        <th>No.</th>
        <th>Registro</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?
    $conn = mysqli_connect($host,$user,$password,$db);
    $sql = "SELECT * FROM logs WHERE USER = '$_SESSION[usuario]' ";
    $result = mysqli_query($conn,$sql) ;
    //Paginacion
    $num_total_registros = mysqli_num_rows($result);

    //Limito la busqueda
    $TAMANO_PAGINA = 20;

    if  ( ($num_total_registros / 2) < $TAMANO_PAGINA )
    {
      $TAMANO_PAGINA = $num_total_registros;
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

    $sql = "SELECT l.id, u.name, l.fecha, l.registro FROM logs l, users u where l.user = u.id and l.user = '$_SESSION[usuario]' ORDER BY id DESC LIMIT ".$inicio.",". "$TAMANO_PAGINA";

    $result = mysqli_query($conn,$sql);


    while($row = mysqli_fetch_array($result)){
    echo "
    <tr>
        <td>".$row[0]."</td>
        <td>".substr($row[3], 0, 80)."</td>
        <td>".
        '<div class="split-button">
          <button class="button" onclick="Metro.dialog.open('."'#".$row[0]."'".')" ><span class="mif-eye"></span> Detalles</button>
          <button class="split dropdown-toggle"></button>
          <ul class="d-menu" data-role="dropdown">
              <li><a '.(($_SESSION['delete_logs'] == 0)?' hidden':"").' onclick="'."delete".$row[0]."()".'"><span class="mif-bin"></span> Eliminar</a></li>
          </ul>
      </div>

      '
        ."</td>

        <script>
          function delete".$row[0]."(){
              Metro.dialog.create({
                  title: '".''."',
                  content: '<div>SE ELIMINARA EL REGISTRO NO.".$row[0].".'
                    +'<form  action=func/delete_log.php method=POST name=".'"delete'.$row[0].'"'." >'
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
            <div class='dialog-title'>".'USUARIO: '."
            ".$row[1]."</div>
            <div class='dialog-content'>
                ID: ".$row[0]."
                <br>FECHA: ".$row[2]."
                <br>REGISTRO: ".$row[3]."
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
        echo '<li class="page-item service"><a class="page-link" href="my_logs.php?pagina='.($pagina - 1 ).'"><span class="mif-arrow-left"></span></a></li>';
    }else {
        echo '<li class="page-item service"><a class="page-link" ><span class="mif-arrow-left"></span></a></li>';
    }

    if ($total_paginas > 1) {
      for ($i=1;$i<=$total_paginas;$i++) {
         if ($pagina == $i)
            echo '<li class="page-item active"><a class="page-link" >'.$i.'</a></li>';
         else
            echo '<li class="page-item"><a class="page-link" href="my_logs.php?pagina='.$i.'">'.$i.'</a></li>';

      }
    }
    if ($pagina < $total_paginas)
    {
        echo '<li class="page-item service"><a class="page-link" href="my_logs.php?pagina='.($pagina + 1 ).'"><span class="mif-arrow-right"></span></a></li>';
    }else {
        echo '<li class="page-item service"><a class="page-link" ><span class="mif-arrow-right"></span></a></li>';
    }
    ?>
</ul>
<?php include 'func/footer.php' ?>
<script>

      if (getUrlVars()["delete"])
      {
          Metro.notify.create("Registro eliminado con exito", "<span class='mif-checkmark'></span> Eliminado", {cls: "success"});
      }

      if (getUrlVars()["nodelete"])
      {
          Metro.notify.create("Registro NO eliminado", "<span class='mif-cross'></span> No eliminado", {cls: "alert"});
      }

      function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
        });
        return vars;
      }

  </script>
