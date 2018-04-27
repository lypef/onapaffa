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

<form  action=func/add_user_action.php method="POST" autocomplete="off">
<div class="row">

  <div class="cell-md-3">
    <div style="margin-left: 1em; margin-right: 1em;">
    <label class="container1">Agregar titular
      <input id="add_titular" name="add_titular" type="checkbox" ".(($row[4] == 1)?" checked":"").">
      <span class="checkmark1"></span>
    </label>

    <label class="container1">Editar titular
      <input id="edit_titular" name="edit_titular" type="checkbox" ".(($row[5] == 1)?" checked":"").">
      <span class="checkmark1"></span>
    </label>

    <label class="container1">Eliminar titular
      <input id="delete_titular" name="delete_titular" type="checkbox" ".(($row[6] == 1)?" checked":"").">
      <span class="checkmark1"></span>
    </label>

    <label class="container1">Agregar vehiculo
      <input id="add_vehicle" name="add_vehicle" type="checkbox" ".(($row[7] == 1)?" checked":"").">
      <span class="checkmark1"></span>
    </label>

    <label class="container1">Editar vehiculo
      <input id="edit_vehicle" name="edit_vehicle" type="checkbox" ".(($row[8] == 1)?" checked":"").">
      <span class="checkmark1"></span>
    </label>

    <label class="container1">Eliminar vehiculo
      <input id="delete_vehicle" name="delete_vehicle" type="checkbox" ".(($row[9] == 1)?" checked":"").">
      <span class="checkmark1"></span>
    </label>

    <label class="container1">Agregar adicional
      <input id="add_adicional" name="add_adicional" type="checkbox" ".(($row[10] == 1)?" checked":"").">
      <span class="checkmark1"></span>
    </label>
    </div>
  </div>

  <div class="cell-md-3">
    <div style="margin-left: 1em; margin-right: 1em;">
    <label class="container1">Editar adicional
      <input id="edit_adicional" name="edit_adicional" type="checkbox" ".(($row[11] == 1)?" checked":"").">
      <span class="checkmark1"></span>
    </label>

    <label class="container1">Eliminar adicional
      <input id="delete_adicional" name="delete_adicional" type="checkbox" ".(($row[12] == 1)?" checked":"").">
      <span class="checkmark1"></span>
    </label>

    <label class="container1">Gestionar usuarios
      <input id="crud_users" name="crud_users" type="checkbox" ".(($row[13] == 1)?" checked":"").">
      <span class="checkmark1"></span>
    </label>

    <label class="container1">Generar reportes
      <input id="gen_reports" name="gen_reports" type="checkbox" ".(($row[14] == 1)?" checked":"").">
      <span class="checkmark1"></span>
    </label>

    <label class="container1">Eliminar registros
      <input id="delete_logs" name="delete_logs" type="checkbox" ".(($row[15] == 1)?" checked":"").">
      <span class="checkmark1"></span>
    </label>

    <label class="container1">Gestionar sucursales
      <input id="gest_sucursales" name="gest_sucursales" type="checkbox" ".(($row[16] == 1)?" checked":"").">
      <span class="checkmark1"></span>
    </label>
    </div>
  </div>

  <div class="cell-md-6">
    <div style="margin-left: 1em; margin-right: 1em; margin-bottom: 1em;">
      <input id="nombre" name="nombre" type="text" data-role="input" data-prepend="Nombre" placeholder="Escriba nombre completo" autofocus>
      <input id="username" name="username" type="text" data-role="input" data-prepend="Username" placeholder="Nombre de usuario" required>
      <input id="password" name="password" type="password" data-role="input" data-prepend="Contraseña" placeholder="Contraseña de nuevo usuario" required>
      <br><button type="submit" class="button info"><span class="mif-checkmark"></span> Guardar</button>
    </div>
  </div>

</div>

</div>
</form>
</div>
<br>

</div>
<?php include 'func/footer.php' ?>
<script>

      if (getUrlVars()["exist"])
      {
          Metro.notify.create("No es posible agregar el usuario por que ya existe", "<span class='mif-cross'></span> Ya existe", {cls: "alert"});
      }

      if (getUrlVars()["add"])
      {
          Metro.notify.create("Usuario agregado con exito", "<span class='mif-checkmark'></span> Agregado", {cls: "success"});
      }

      if (getUrlVars()["noadd"])
      {
          Metro.notify.create("No es posible agregar el usuario", "<span class='mif-cross'></span> Error", {cls: "warning"});
      }

      function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
        });
        return vars;
      }

  </script>
