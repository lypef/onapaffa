<?php
  error_reporting(0);
  require_once 'db.php';

  $id = $_POST['id'];

  mysql_query("delete from vehiculos where id = '$id' ");
  if (mysql_affected_rows() > 0)
  {
    echo '<script>location.href = "../gest_vehicles.php?pagina=1?&delete=true"</script>';
  }else {
    echo '<script>location.href = "../gest_vehicles.php?pagina=1?&nodelete=true"</script>';
  }
?>
