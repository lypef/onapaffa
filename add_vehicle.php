<?php
  include 'func/header.php';
  require_once 'func/db.php';
  $conn = mysqli_connect($host,$user,$password,$db);

  $sql = "SELECT * FROM titulares";
  $result = mysqli_query($conn,$sql) ;

  $sql_suc = "SELECT * FROM sucursales";
  $result_suc = mysqli_query($conn,$sql_suc) ;
  if ($_SESSION['add_vehicle'] == 0)
  {
      echo '<script>location.href = "manager.php?nopermitido=true"</script>';
  }
?>
<br>
<h2 id="inputs">Nuevo vehiculo</h2>
<div class="example">
    <form  action="func/add_vehicle_action.php" method="POST" enctype="multipart/form-data">
          <select  name="sucursal" id="sucursal" required>
            <option value="">SELECCIONE SUCURSAL</option>
            <?php
            while($row = mysqli_fetch_array($result_suc))
            {
              echo '<option value="'.$row[0].'">'.$row[1].'</option>';
            }
            ?>
          </select>
          <select  name="titular" id="titular" required>
          <option value="">SELECCIONE UN TITULAR</option>
          <?php
          while($row = mysqli_fetch_array($result))
          {
            echo '<option value="'.$row[0].'">'.$row[1].'</option>';
          }
          ?>
        </select>
        <input id="serie" name="serie" type="text" data-role="input" data-prepend="Serie:" placeholder="Serie del vehiculo" maxlength="17" required>
        <input id="linea" name="linea" type="text" data-role="input" data-prepend="Linea:" placeholder="Linea a la que pertenece el vehiculo" required>
        <select  name="tipo" id="tipo" required>
          <option value="">SELECCIONE UN TIPO DE VEHICULO</option>
          <option value="SEDAN">SEDAN</option>
          <option value="VAGONETA">VAGONETA</option>
          <option value="PICKUP">PICKUP</option>
          <option value="CAMION">CAMION</option>
        </select>
        <input id="modelo" name="modelo" type="text" data-role="input" data-prepend="Modelo:" placeholder="Modelo del vehiculo" required>
        <input id="marca" name="marca" type="text" data-role="input" data-prepend="Marca:" placeholder="Marca del vehiculo" required>
        <input id="cilindros" name="cilindros" type="text" data-role="input" data-prepend="No. de cilindros:" placeholder="Numero de cilindros" required>
        <input id="color" name="color" type="text" data-role="input" data-prepend="Color:" placeholder="Color de vehiculo" required>
        <input id="engomado" name="engomado" type="text" data-role="input" data-prepend="Engomado:" placeholder="Engomado de vehiculo" required>
        <input id="foto" name="foto" type="file" data-role="file" placeholder="Buscar fotografia" class="mt-2" accept="image/jpeg,image/jpg">
        <input id="f_expedicion" name="f_expedicion" data-role="calendarpicker"  data-calendar-button-icon="<span class='mif-calendar'></span>" placeholder="Fecha expedicion" required value="<? echo date("Y/m/d") ?>">
        <input id="f_vencimiento" name="f_vencimiento" data-role="calendarpicker"  data-calendar-button-icon="<span class='mif-calendar'></span>" placeholder="Fecha de vencimiento" required value="<?
            $fecha = date("Y/m/d");
            $nuevafecha = strtotime ( '+366 day' , strtotime ( $fecha ) ) ;
            $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
            echo $nuevafecha; ?>">
        <div class="p-4 d-flex flex-justify-between border bd-default bg-scheme-secondary">
          <input id="estatus" name="estatus" type="checkbox" data-role="switch" data-caption="Estatus" title="" checked>
          <button class="button" style="background-color: #1979ca" ><span class='mif-floppy-disk'></span> Guardar</button>
        </div>
</form>
</div>
<br><br>
<?php include 'func/footer.php' ?>
<script>

      if (getUrlVars()["error"])
      {
          Metro.notify.create("Titular NO agregado", "<span class='mif-cross'></span> Error", {cls: "alert"});
      }

      if (getUrlVars()["success"])
      {
          Metro.notify.create("Vehiculo agregado", "<span class='mif-checkmark'></span> Agregado", {cls: "success"});
      }

      if (getUrlVars()["error_image"])
      {
          Metro.notify.create("Error al cargar imagen", "<span class='mif-cross'></span> Error imagen", {cls: "alert"});
      }

      if (getUrlVars()["engomado_exist"])
      {
          Metro.notify.create("El engomado ya existe", "<span class='mif-cross'></span> Duplicado", {cls: "alert"});
      }

        document.getElementById("titular").value = getUrlVars()["titular"].replace("%", " ");
        document.getElementById("serie").value = getUrlVars()["serie"].replace("%", " ");
        document.getElementById("linea").value = getUrlVars()["linea"].replace("%", " ");
        document.getElementById("tipo").value = getUrlVars()["tipo"].replace("%", " ");
        document.getElementById("modelo").value = getUrlVars()["modelo"].replace("%", " ");
        document.getElementById("marca").value = getUrlVars()["marca"].replace("%", " ");
        document.getElementById("cilindros").value = getUrlVars()["cilindros"].replace("%", " ");
        document.getElementById("color").value = getUrlVars()["color"].replace("%", " ");
        document.getElementById("engomado").value = getUrlVars()["engomado"].replace("%", " ");
        document.getElementById("f_expedicion").value = getUrlVars()["f_expedicion"].replace("%", " ");
        document.getElementById("f_vencimiento").value = getUrlVars()["f_vencimiento"].replace("%", " ");
        document.getElementById("sucursal").value = getUrlVars()["sucursal"].replace("%", " ");

      function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
        });
        return vars;
      }
  </script>
