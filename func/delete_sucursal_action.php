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

  mysql_query("delete from sucursales where id = '$id' ");
  if (mysql_affected_rows() > 0)
  {
    echo '<script>location.href = "../gest_sucursales.php?delete=true"</script>';
  }else {
    echo '<script>location.href = "../gest_sucursales.php?nodelete=true"</script>';
  }
}
?>
