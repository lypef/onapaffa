<?php
session_start();
if ($_SESSION['crud_users'] == 0)
{
    echo '<script>location.href = "../manager.php?nopermitido=true"</script>';
}else
{
  error_reporting(0);
  require_once 'db.php';

  function GetIntValue($tmp)
  {
    if ($tmp)
    {
      $r = 1;
    }else {
      $r = 0;
    }
    return $r;
  }

  $name = $_POST['nombre'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $add_titular = GetIntValue($_POST['add_titular']);
  $edit_titular = GetIntValue($_POST['edit_titular']);
  $delete_titular = GetIntValue($_POST['delete_titular']);
  $add_vehicle = GetIntValue($_POST['add_vehicle']);
  $edit_vehicle = GetIntValue($_POST['edit_vehicle']);
  $delete_vehicle = GetIntValue($_POST['delete_vehicle']);
  $add_adicional = GetIntValue($_POST['add_adicional']);
  $edit_adicional = GetIntValue($_POST['edit_adicional']);
  $delete_adicional = GetIntValue($_POST['delete_adicional']);
  $crud_users = GetIntValue($_POST['crud_users']);
  $gen_reports = GetIntValue($_POST['gen_reports']);
  $delete_logs = GetIntValue($_POST['delete_logs']);
  $gest_sucursales = GetIntValue($_POST['gest_sucursales']);

  $sql = "INSERT INTO users (username, password, name, add_titular, edit_titular, delete_titular, add_vehicle, edit_vehicle, delete_vehicle, add_adicional, edit_adicional, delete_adicional, crud_users, gen_reports, delete_logs, gest_sucursales) VALUES ('$username', '$password', '$name', '$add_titular', '$edit_titular', '$delete_titular', '$add_vehicle', '$edit_vehicle', '$delete_vehicle', '$add_adicional', '$edit_adicional', '$delete_adicional', '$crud_users', '$gen_reports', '$delete_logs', '$gest_sucursales');";

  if (ReturnAddUserBool($username))
  {
    mysql_query($sql);
    if (mysql_affected_rows() > 0)
    {
      echo '<script> location.href = "../add_users.php?add=true";</script>';
    }else {
      echo '<script> location.href = "../add_users.php?noadd=true";</script>';
    }
  }else {
    echo '<script> location.href = "../add_users.php?exist=true";</script>';
  }

}
?>
