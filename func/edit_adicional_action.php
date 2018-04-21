<?php
  error_reporting(0);
  require_once 'db.php';

  $id = $_POST['adicional'];
  $name = $_POST['nombre'];
  $domicilio = $_POST["domicilio"];
  $cp = $_POST["cp"];
  $telefono = $_POST["telefono"];

  $foto=$_FILES["foto"]["name"];
  $ruta=$_FILES["foto"]["tmp_name"];
  $nameimg = 'adicional_'.date("YmdHis");
  $destino="../fotografias/".$nameimg.".jpg";
  $ruta_foto="fotografias/".$nameimg.".jpg";

  if ($foto)
  {
    if (copy($ruta,$destino))
    {
      mysql_query("update adicionales set nombre = '$name', domicilio = '$domicilio', cp = '$cp', telefono = '$telefono', foto = '$ruta_foto' where id = '$id' ");
      if (mysql_affected_rows() > 0)
      {
        unlink('../'+$_foto);
        echo '<script>location.href = "../gest_adicionales.php?pagina=1?&update=true"</script>';
      }else {
        echo '<script>location.href = "../gest_adicionales.php?pagina=1?&noupdate=true"</script>';
      }
    }else {
      echo '<script>location.href = "../gest_adicionales.php?pagina=1?&noupdate=true"</script>';
    }
  }else {
    mysql_query("update adicionales set nombre = '$name', domicilio = '$domicilio', cp = '$cp', telefono = '$telefono' where id = '$id' ");
    if (mysql_affected_rows() > 0)
    {
      echo '<script>location.href = "../gest_adicionales.php?pagina=1?&update=true"</script>';
    }else {
      echo '<script>location.href = "../gest_adicionales.php?pagina=1?&noupdate=true"</script>';
    }
  }
?>
