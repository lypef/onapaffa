<?php
  error_reporting(0);
  require_once 'db.php';

  $id = $_POST['id'];
  $log = 'se elimino registro: '.$id;

  mysql_query("delete from logs where id = '$id' ");
  if (mysql_affected_rows() > 0)
  {
    AddLog($log);
    echo '<script>location.href = "../my_logs.php?pagina=1?&delete=true"</script>';
  }else {
    echo '<script>location.href = "../my_logs.php?pagina=1?&nodelete=true"</script>';
  }
?>
