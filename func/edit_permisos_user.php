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

  $id = $_POST['id'];
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

  $sql = "UPDATE users SET add_titular = '$add_titular', edit_titular = '$edit_titular', delete_titular = '$delete_titular', add_vehicle = '$add_vehicle', edit_vehicle = '$edit_vehicle', delete_vehicle = '$delete_vehicle', add_adicional = '$add_adicional', edit_adicional = '$edit_adicional', delete_adicional = '$delete_adicional', crud_users = '$crud_users', gen_reports = '$gen_reports', delete_logs = '$delete_logs', gest_sucursales = '$gest_sucursales' WHERE id = '$id';";

  mysql_query($sql);
  if (mysql_affected_rows() > 0)
  {
    echo '<script> location.href = "../gest_users.php?update_profile=true";</script>';
  }else {
    echo '<script> location.href = "../gest_users.php?noupdate_profile=true";</script>';
  }
}
?>
