<?php
  error_reporting(0);
  require_once 'db.php';

  $id = $_POST['id'];
  $nombre = $_POST['name'];
  $password = $_POST["password"];
  $password_confirm = $_POST["password_confirm"];
  $sql = "";

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
  session_start();
  session_destroy();
  if (mysql_affected_rows() > 0)
  {
    echo '<script> location.href = "../index.php?update_profile=true";</script>';
  }else {
    echo '<script> location.href = "../index.php?noupdate_profile=true";</script>';
  }
?>
