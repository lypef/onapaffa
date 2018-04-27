<?php
session_start();
if ($_SESSION['gest_sucursales'] == 0)
{
    echo '<script>location.href = "../manager.php?nopermitido=true"</script>';
}else
{
  error_reporting(0);
  require_once 'db.php';

  $id = $_POST['id'];
  $nombre = $_POST['name'];
  $direccion = $_POST['direccion'];
  $telefono = $_POST["telefono"];

  $sql = "update sucursales set nombre = '$nombre', direccion = '$direccion', telefono = '$telefono'  where id = '$id' ";

  mysql_query($sql);
  if (mysql_affected_rows() > 0)
  {
    echo '<script> location.href = "../gest_sucursales.php?update=true";</script>';
  }else {
    echo '<script> location.href = "../gest_sucursales.php?noupdate=true";</script>';
  }
}
?>
