<?php
session_start();
if ($_SESSION['gest_sucursales'] == 0)
{
    echo '<script>location.href = "../manager.php?nopermitido=true"</script>';
}else
{
  error_reporting(0);
  session_start();
  $userid = $_SESSION['usuario'];
  require_once 'db.php';

  $name = $_POST['name'];
  $direccion = $_POST["direccion"];
  $telefono = $_POST["telefono"];

  mysql_query("insert into sucursales (nombre, direccion, telefono) values ('$name','$direccion', '$telefono')");
  if (mysql_affected_rows() > 0)
  {
    AddLog('agrego sucursal: '.$name);
    echo '<script>location.href = "../gest_sucursales.php?success=true"</script>';
  }else {
    echo '<script>location.href = "../gest_sucursales.php?error=true"</script>';
  }

}
?>
