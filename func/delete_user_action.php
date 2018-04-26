<?php
session_start();
if ($_SESSION['crud_users'] == 0)
{
    echo '<script>location.href = "../manager.php?nopermitido=true"</script>';
}else
{
  error_reporting(0);
  require_once 'db.php';

  $id = $_POST['id'];

  mysql_query("delete from users where id = '$id' ");
  if (mysql_affected_rows() > 0)
  {
    echo '<script>location.href = "../gest_users.php?delete=true"</script>';
  }else {
    echo '<script>location.href = "../gest_users.php?nodelete=true"</script>';
  }
}
?>
