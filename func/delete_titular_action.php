<?php
  error_reporting(0);
  require_once 'db.php';

  $id = $_POST['id'];
  $log = 'se elimino titular: '.ReturnNameTitular($id). ' numero de usuario: '.$id;

  mysql_query("delete from titulares where id = '$id' ");
  if (mysql_affected_rows() > 0)
  {
    AddLog($log);
    echo '<script>location.href = "../gest_titulares.php?pagina=1?&delete=true"</script>';
  }else {
    echo '<script>location.href = "../gest_titulares.php?pagina=1?&nodelete=true"</script>';
  }
?>
