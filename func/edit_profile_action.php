<?php
  error_reporting(0);
  require_once 'db.php';

  $id = $_POST['id'];
  $nombre = $_POST['name'];
  $password = $_POST["password"];
  $password_confirm = $_POST["password_confirm"];
  $sql = "";
  $log = 'Usuario actualizo su informacion';

  if (!empty($password))
  {
    if ($password == $password_confirm)
    {
      $password = md5($password);
      $sql = "update users set name = '$nombre', password = '$password'  where id = '$id' ";
    }else {
      echo "no iguales";
    }
  }else {
    $sql = "update users set name = '$nombre' where id = '$id' ";
  }

  mysql_query($sql);
  if (mysql_affected_rows() > 0)
  {
    AddLog($log);
    session_start();
    session_destroy();
    echo '<script> location.href = "../index.php?update_profile=true";</script>';
  }else {
    session_start();
    session_destroy();
    echo '<script> location.href = "../index.php?noupdate_profile=true";</script>';
  }
?>
