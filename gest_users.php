<? include 'func/header.php' ?>
<? require_once 'func/db.php' ?>
<?
  if ($_SESSION['crud_users'] == 0)
  {
      echo '<script>location.href = "manager.php?nopermitido=true"</script>';
  }
?>
<br>
<style>
/* The container */
.container1 {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 18px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.container1 input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark1 {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container1:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container1 input:checked ~ .checkmark1 {
    background-color: black;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark1:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.container1 input:checked ~ .checkmark1:after {
    display: block;
}

/* Style the checkmark/indicator */
.container1 .checkmark1:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
<div style="background-color: white;">
<br>
<table class="table striped">
    <thead>
    <tr>
        <th>No.</th>
        <th>Nombre</th>
        <th>Username</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?
    $conn = mysqli_connect($host,$user,$password,$db);
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array($result)){
    echo "
    <tr>
        <td>".$row[0]."</td>
        <td>".$row[3]."</td>
        <td>".$row[1]."</td>
        <td>".
        '<div class="split-button">
          <button class="button" onclick="Metro.dialog.open('."'#".$row[0]."'".')" ><span class="mif-eye"></span> Detalles</button>
          <button class="split dropdown-toggle"></button>
          <ul class="d-menu" data-role="dropdown">
              <li><a onclick="Metro.dialog.open('."'#permisos".$row[0]."'".')"><span class="mif-security"></span> Permisos</a></li>
              <li class="divider"></li>
              <li><a onclick="Metro.dialog.open('."'#update".$row[0]."'".')"><span class="mif-pencil"></span> Editar</a></li>
              <li><a onclick="Metro.dialog.open('."'#delete".$row[0]."'".')"><span class="mif-bin"></span> Eliminar</a></li>
          </ul>
      </div>

      '."</td>

      <div class='dialog' data-role='dialog' id=".'permisos'.$row[0].">
          <div class='dialog-title'>".'USUARIO: '."
          ".$row[3]."</div>
          <div class='dialog-content'>
            <form  action=func/edit_permisos_user.php method='POST'>
            <input id='id' name='id' hidden value=".$row[0].">
            <div class='row'>

              <div class='cell-md-6'>

              <label class='container1'>Agregar titular
                <input id='add_titular' name='add_titular' type='checkbox' ".(($row[4] == 1)?' checked':'').">
                <span class='checkmark1'></span>
              </label>

              <label class='container1'>Editar titular
                <input id='edit_titular' name='edit_titular' type='checkbox' ".(($row[5] == 1)?' checked':'').">
                <span class='checkmark1'></span>
              </label>

              <label class='container1'>Eliminar titular
                <input id='delete_titular' name='delete_titular' type='checkbox' ".(($row[6] == 1)?' checked':'').">
                <span class='checkmark1'></span>
              </label>

              <label class='container1'>Agregar vehiculo
                <input id='add_vehicle' name='add_vehicle' type='checkbox' ".(($row[7] == 1)?' checked':'').">
                <span class='checkmark1'></span>
              </label>

              <label class='container1'>Editar vehiculo
                <input id='edit_vehicle' name='edit_vehicle' type='checkbox' ".(($row[8] == 1)?' checked':'').">
                <span class='checkmark1'></span>
              </label>

              <label class='container1'>Eliminar vehiculo
                <input id='delete_vehicle' name='delete_vehicle' type='checkbox' ".(($row[9] == 1)?' checked':'').">
                <span class='checkmark1'></span>
              </label>

              <label class='container1'>Agregar adicional
                <input id='add_adicional' name='add_adicional' type='checkbox' ".(($row[10] == 1)?' checked':'').">
                <span class='checkmark1'></span>
              </label>
              </div>

              <div class='cell-md-6'>
              <label class='container1'>Editar adicional
                <input id='edit_adicional' name='edit_adicional' type='checkbox' ".(($row[11] == 1)?' checked':'').">
                <span class='checkmark1'></span>
              </label>

              <label class='container1'>Eliminar adicional
                <input id='delete_adicional' name='delete_adicional' type='checkbox' ".(($row[12] == 1)?' checked':'').">
                <span class='checkmark1'></span>
              </label>

              <label class='container1'>Gestionar usuarios
                <input id='crud_users' name='crud_users' type='checkbox' ".(($row[13] == 1)?' checked':'').">
                <span class='checkmark1'></span>
              </label>

              <label class='container1'>Generar reportes
                <input id='gen_reports' name='gen_reports' type='checkbox' ".(($row[14] == 1)?' checked':'').">
                <span class='checkmark1'></span>
              </label>

              <label class='container1'>Eliminar registros
                <input id='delete_logs' name='delete_logs' type='checkbox' ".(($row[15] == 1)?' checked':'').">
                <span class='checkmark1'></span>
              </label>

              <label class='container1'>Gestionar sucursales
                <input id='gest_sucursales' name='gest_sucursales' type='checkbox' ".(($row[16] == 1)?' checked':'').">
                <span class='checkmark1'></span>
              </label>
              </div>
            </div>



          </div>
          <div class='dialog-actions'>
              <button type='submit' class='button info'><span class='mif-checkmark'></span> Guardar</button>
              </form>
              <button class='button js-dialog-close'><span class='mif-checkmark'></span> Cancelar</button>
          </div>
      </div>


      <div class='dialog' data-role='dialog' id=".'delete'.$row[0].">
          <div class='dialog-title'>".'USUARIO: '."
          ".$row[3]."</div>
          <div class='dialog-content'>
            <form  action=func/delete_user_action.php method=POST>
              <input  type='text' name='id' id='id' value=".'"'.$row[0].'"'." hidden>
              Piensalo dos veces ! Despues de esta accion no hay manera de recuperar el usuario ni sus movimientos (titulares, vehiculos, adicionales)
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
              <form  action=func/edit_user_values.php method=POST>
                <input  type='text' name='id' id='id' value=".'"'.$row[0].'"'." hidden>
                <input  value=".'"'.$row[3].'"'." id='name' name='name' type='text'  data-prepend='Nombre' placeholder='Nombre' >
                <input  id='password' name='password' type='password'  data-prepend='Nombre' placeholder='Contraseña' >
                <input  id='password_confirm' name='password_confirm' type='password'  data-prepend='Nombre' placeholder='Repita' >
                <input type=submit hidden>
            </div>
            <div class='dialog-actions'>
                <button type='submit' class='button info'><span class='mif-checkmark'></span> Guardar</button>
                </form>
                <button class='button js-dialog-close'><span class='mif-checkmark'></span> Cancelar</button>
            </div>
        </div>

        <div class='dialog' data-role='dialog' id=".$row[0].">
            <div class='dialog-title'>".'USUARIO: '."
            ".$row[3]."</div>
            <div class='dialog-content'>
                ID: ".$row[0]."
                <br>NOMBRE DE USUARIO: ".$row[1]."
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

      if (getUrlVars()["update_profile"])
      {
          Metro.notify.create("Usuario actualizado con exito", "<span class='mif-checkmark'></span> Actualizado", {cls: "success"});
      }

      if (getUrlVars()["noupdate_profile"])
      {
          Metro.notify.create("No es posible actualizar el usuario", "<span class='mif-cross'></span> Error", {cls: "alert"});
      }

      if (getUrlVars()["delete"])
      {
          Metro.notify.create("Usuario eliminado con exito", "<span class='mif-checkmark'></span> Eliminado", {cls: "success"});
      }

      if (getUrlVars()["nodelete"])
      {
          Metro.notify.create("No es posible eliminar el usuario", "<span class='mif-cross'></span> Error", {cls: "alert"});
      }

      function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
        });
        return vars;
      }

  </script>
