<?php
  session_start();
  if ($_SESSION['edit_titular'] == 0)
  {
      echo '<script>location.href = "../manager.php?nopermitido=true"</script>';
  }else
  {
    error_reporting(0);
    require_once 'db.php';

    $id = $_POST['id'];
    $name = $_POST['_nombre'];
    $domicilio = $_POST["domicilio"];
    $cp = $_POST["cp"];
    $telefono = $_POST["telefono"];
    $suc = $_POST['sucursal'];
    $_foto = $_POST["_foto"];


    $foto=$_FILES["foto"]["name"];
    $ruta=$_FILES["foto"]["tmp_name"];
    $nameimg = date("YmdHis");
    $destino="../fotografias/".$nameimg.".jpg";
    $ruta_foto="fotografias/".$nameimg.".jpg";

    $log = 'se actualizo informacion de titular: '.ReturnNameTitular($id). ' numero de usuario: '.$id;

    if ($foto)
    {
      if (copy($ruta,$destino))
      {

        if ($suc > 0)
        {
          mysql_query("update titulares set nombre = '$name', domicilio = '$domicilio', cp = '$cp', telefono = '$telefono', fotografia = '$ruta_foto', sucursal = '$suc' where id = '$id' ");
        }else {
          mysql_query("update titulares set nombre = '$name', domicilio = '$domicilio', cp = '$cp', telefono = '$telefono', fotografia = '$ruta_foto' where id = '$id' ");
        }
        if (mysql_affected_rows() > 0)
        {
          unlink('../'+$_foto);
          AddLog($log);
          echo '<script>location.href = "../gest_titulares.php?pagina=1?&update=true"</script>';
        }else {
          echo '<script>location.href = "../gest_titulares.php?pagina=1?&noupdate=true"</script>';
        }
      }else {
        echo '<script>location.href = "../gest_titulares.php?pagina=1?&noupdate=true"</script>';
      }
    }else {
      if ($suc > 0)
      {
        mysql_query("update titulares set nombre = '$name', domicilio = '$domicilio', cp = '$cp', telefono = '$telefono', sucursal = '$suc' where id = '$id' ");
      }else {
        mysql_query("update titulares set nombre = '$name', domicilio = '$domicilio', cp = '$cp', telefono = '$telefono' where id = '$id' ");
      }
      if (mysql_affected_rows() > 0)
      {
        AddLog($log);
        echo '<script>location.href = "../gest_titulares.php?pagina=1?&update=true"</script>';
      }else {
        echo '<script>location.href = "../gest_titulares.php?pagina=1?&noupdate=true"</script>';
      }
    }
  }
?>
