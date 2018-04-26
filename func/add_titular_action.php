<?php
session_start();
if ($_SESSION['add_titular'] == 0)
{
    echo '<script>location.href = "../manager.php?nopermitido=true"</script>';
}else
{
  error_reporting(0);
  session_start();
  $userid = $_SESSION['usuario'];
  require_once 'db.php';
  $name = $_POST['_nombre'];
  $domicilio = $_POST["domicilio"];
  $cp = $_POST["cp"];
  $telefono = $_POST["telefono"];
  $suc = $_POST["sucursal"];

  $foto=$_FILES["foto"]["name"];
  $ruta=$_FILES["foto"]["tmp_name"];
  $nameimg = date("YmdHis");
  $destino="../fotografias/".$nameimg.".jpg";
  $ruta_foto="fotografias/".$nameimg.".jpg";

  if (copy($ruta,$destino))
  {
    mysql_query("insert into titulares (nombre,domicilio,cp, telefono, fotografia, atendio, sucursal)
              values ('$name','$domicilio','$cp', '$telefono', '$ruta_foto', '$userid', '$suc')");
    if (mysql_affected_rows() > 0)
    {
      AddLog('alta titular: '.$name);
      echo '<script>location.href = "../add_titular.php?success=true"</script>';
    }else {
      echo '<script>location.href = "../add_titular.php?error=true&nombre='.$name.'&domicilio='.$domicilio.'&cp='.$cp.'&telefono='.$telefono.'&sucursal='.$suc.'"</script>';
    }
  }else {
    echo '<script>location.href = "../add_titular.php?error_image=true&nombre='.$name.'&domicilio='.$domicilio.'&cp='.$cp.'&telefono='.$telefono.'&sucursal='.$suc.'"</script>';
  }
}
?>
