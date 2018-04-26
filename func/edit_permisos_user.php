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
  $add_titular = $_POST['add_titular'];
  $edit_titular = $_POST['edit_titular'];
  $delete_titular = $_POST['delete_titular'];
  $add_vehicle = $_POST['add_vehicle'];
  $edit_vehicle = $_POST['edit_vehicle'];
  $delete_vehicle = $_POST['delete_vehicle'];
  $add_adicional = $_POST['add_adicional'];
  $edit_adicional = $_POST['edit_adicional'];
  $delete_adicional = $_POST['delete_adicional'];
  $crud_users = $_POST['crud_users'];
  $gen_reports = $_POST['gen_reports'];
  $delete_logs = $_POST['delete_logs'];

  echo $add_titular;
  $sql = "";


  /*
  mysql_query($sql);
  if (mysql_affected_rows() > 0)
  {
    echo '<script> location.href = "../gest_users.php?update_profile=true";</script>';
  }else {
    echo '<script> location.href = "../gest_users.php?noupdate_profile=true";</script>';
  }*/
}
?>
