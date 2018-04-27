<? include 'func/header.php' ?>
<? require_once 'func/db.php' ?>
<?
  if ($_SESSION['gest_sucursales'] == 0)
  {
      echo '<script>location.href = "manager.php?nopermitido=true"</script>';
  }
?>
<br>
<div style="background-color: white;">
<br>
<table class="table striped">
    <thead>
    <tr>
        <th>No.</th>
        <th>Sucursal</th>
        <th>Direccion</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?
    $conn = mysqli_connect($host,$user,$password,$db);
    $sql = "SELECT * FROM sucursales";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array($result)){
    echo "
    <tr>
        <td>".$row[0]."</td>
        <td>".$row[1]."</td>
        <td>".$row[2]."</td>
        <td>".
        '<div class="split-button">
          <button class="button" onclick="Metro.dialog.open('."'#".$row[0]."'".')" ><span class="mif-eye"></span> Detalles</button>
          <button class="split dropdown-toggle"></button>
          <ul class="d-menu" data-role="dropdown">
              <li><a onclick="Metro.dialog.open('."'#update".$row[0]."'".')"><span class="mif-pencil"></span> Editar</a></li>
              <li><a onclick="Metro.dialog.open('."'#delete".$row[0]."'".')"><span class="mif-bin"></span> Eliminar</a></li>
          </ul>
      </div>

      '."</td>


      <div class='dialog' data-role='dialog' id=".'delete'.$row[0].">
          <div class='dialog-title'>".'SUCURSAL: '."
          ".$row[1]."</div>
          <div class='dialog-content'>
            <form  action=func/delete_sucursal_action.php method=POST>
              <input  type='text' name='id' id='id' value=".'"'.$row[0].'"'." hidden>
              Piensalo dos veces ! Despues de esta accion no hay manera de recuperar la sucursal ni sus agregados (titulares, vehiculos, adicionales)
          </div>
          <div class='dialog-actions'>
              <button type='submit' class='button alert'><span class='mif-bin'></span> Eliminar</button>
              </form>
              <button class='button js-dialog-close'><span class='mif-checkmark'></span> Cancelar</button>
          </div>
      </div>

      <div class='dialog' data-role='dialog' id=".'update'.$row[0].">
            <div class='dialog-title'>".'USUARIO: '."
            ".$row[1]."</div>
            <div class='dialog-content'>
              <form  action=func/edit_sucursal_values.php method=POST>
                <input  type='text' name='id' id='id' value=".'"'.$row[0].'"'." hidden>
                <input  value=".'"'.$row[1].'"'." id=name name=name type=text  data-prepend=".'Nombre: '." placeholder=".'"Esciba nombre de sucursal"'." autofocus>
                <input  value=".'"'.$row[2].'"'." id=direccion name=direccion type=text  data-prepend=".'Direccion: '." placeholder=".'"Direccion sucursal"'." >
                <input  value=".'"'.$row[3].'"'." id=telefono name=telefono type=text  data-prepend=".'Telefono: '." placeholder=".'"Telfono de sucursal"'." >
                <input type=submit hidden>
            </div>
            <div class='dialog-actions'>
                <button type='submit' class='button info'><span class='mif-checkmark'></span> Guardar</button>
                </form>
                <button class='button js-dialog-close'><span class='mif-checkmark'></span> Cancelar</button>
            </div>
        </div>

        <div class='dialog' data-role='dialog' id=".$row[0].">
            <div class='dialog-title'>".'SUCURSAL: '."
            ".$row[1]."</div>
            <div class='dialog-content'>
                ID: ".$row[0]."
                <br>NOMBRE: ".$row[1]."
                <br>DIRECCION: ".$row[2]."
                <br>TELEFONO: ".$row[3]."
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
<?php include 'func/footer.php' ?>
<script>

      if (getUrlVars()["success"])
      {
          Metro.notify.create("sucursal se agrego con exito", "<span class='mif-checkmark'></span> Nueva sucursal", {cls: "success"});
      }

      if (getUrlVars()["error"])
      {
          Metro.notify.create("No es posible agregar una nueva sucursal", "<span class='mif-cross'></span> Error", {cls: "alert"});
      }

      if (getUrlVars()["delete"])
      {
          Metro.notify.create("Se elimino la sucursal exitosamente", "<span class='mif-checkmark'></span> Eliminado", {cls: "success"});
      }

      if (getUrlVars()["nodelete"])
      {
          Metro.notify.create("No fue posible eliminar la sucursal", "<span class='mif-cross'></span> No se elimino", {cls: "alert"});
      }

      if (getUrlVars()["update"])
      {
          Metro.notify.create("Se actualizo la sucursal exitosamente", "<span class='mif-checkmark'></span> Se actualizo", {cls: "success"});
      }

      if (getUrlVars()["noupdate"])
      {
          Metro.notify.create("No fue posible actualizar la sucursal", "<span class='mif-cross'></span> No se actualizo", {cls: "alert"});
      }

      function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
        });
        return vars;
      }

  </script>
