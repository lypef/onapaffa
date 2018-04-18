<?php
  include 'func/header.php';
  require_once 'func/db.php';
  $conn = mysqli_connect($host,$user,$password,$db);
  $sql = "SELECT * FROM titulares";
  $result = mysqli_query($conn,$sql) ;
?>
<br>
<h2 id="inputs">Nuevo vehiculo</h2>
<div class="example">
    <form  action="func/add_vehicle_action.php" method="POST" enctype="multipart/form-data">
        <select  name="titular" id="titular" required>
          <option value="">SELECCIONE UN TITULAR</option>
          <?php
          while($row = mysqli_fetch_array($result))
          {
            echo '<option value="'.$row[0].'">'.$row[1].'</option>';
          }
          ?>

        </select>
        <input id="serie" name="serie" type="text" data-role="input" data-prepend="Serie:" placeholder="Serie del vehiculo" required>
        <input id="tipo" name="tipo" type="text" data-role="input" data-prepend="Tipo:" placeholder="Tipo de vehiculo" required>
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
      //location.href = "href/welcome.php"
      var error = getUrlVars()["error"];
      if (error)
      {
          Metro.notify.create("Titular NO agregado", "<span class='mif-cross'></span>", {cls: "alert"});
      }

      var success = getUrlVars()["success"];
      if (success)
      {
          Metro.notify.create("Vehiculo agregado", "<span class='mif-checkmark'></span>", {cls: "success"});
      }

      var image = getUrlVars()["error_image"];
      if (image)
      {
          Metro.notify.create("Error al cargar imagen", "<span class='mif-cross'></span>", {cls: "alert"});
      }

        document.getElementById("serie").value = getUrlVars()["serie"].replace("%", " ");
        document.getElementById("tipo").value = getUrlVars()["tipo"].replace("%", " ");
        document.getElementById("modelo").value = getUrlVars()["modelo"].replace("%", " ");
        document.getElementById("marca").value = getUrlVars()["marca"].replace("%", " ");
        document.getElementById("cilindros").value = getUrlVars()["cilindros"].replace("%", " ");
        document.getElementById("color").value = getUrlVars()["color"].replace("%", " ");
        document.getElementById("engomado").value = getUrlVars()["engomado"].replace("%", " ");
        document.getElementById("f_expedicion").value = getUrlVars()["f_expedicion"].replace("%", " ");
        document.getElementById("f_vencimiento").value = getUrlVars()["f_vencimiento"].replace("%", " ");
        document.getElementById("titular").value = getUrlVars()["titular"].replace("%", " ");

      function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
        });
        return vars;
      }
  </script>
