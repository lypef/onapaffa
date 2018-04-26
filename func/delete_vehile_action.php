<?php
session_start();
if ($_SESSION['edit_vehicle'] == 0)
{
    echo '<script>location.href = "../manager.php?nopermitido=true"</script>';
}else
{
  error_reporting(0);
  require_once 'db.php';

  $id = $_POST['id'];
  $log = 'se ELIMINO vehiculo no. '.$id;

  mysql_query("delete from vehiculos where id = '$id' ");
  if (mysql_affected_rows() > 0)
  {
    AddLog($log);
    echo '<script>location.href = "../gest_vehicles.php?pagina=1?&delete=true"</script>';
  }else {
    echo '<script>location.href = "../gest_vehicles.php?pagina=1?&nodelete=true"</script>';
  }
}
?>
