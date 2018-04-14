<?php
  error_reporting(0);
  require_once 'db.php';
  $name = $_POST['_nombre'];
  $domicilio = $_POST["domicilio"];
  $cp = $_POST["cp"];
  $telefono = $_POST["telefono"];
  $f_expedicion = str_replace("/","-",$_POST["f_expedicion"]);
  $f_vencimiento = str_replace("/","-",$_POST["f_vencimiento"]);
  if ($_POST["estatus"])
  {
      $estatus = 1;
  }else {
    $estatus = 0;
  }

  $foto=$_FILES["foto"]["name"];
  $ruta=$_FILES["foto"]["tmp_name"];
  $nameimg = date("YmdHis");
  $destino="../fotografias/".$nameimg.".jpg";
  $ruta_foto="fotografias/".$nameimg.".jpg";
  if (copy($ruta,$destino))
  {
    mysql_query("insert into titulares (nombre,domicilio,cp, telefono, fotografia, f_expedicion, f_expiracion, estatus)
              values ('$name','$domicilio','$cp', '$telefono', '$ruta_foto', '$f_expedicion', '$f_vencimiento', '$estatus')");
    if (mysql_affected_rows() > 0)
    {
      echo '<script>location.href = "../add_titular.php?success=true"</script>';
    }else {
      echo '<script>location.href = "../add_titular.php?error=true?nombre=55"</script>';
    }
  }else {
    echo '<script>location.href = "../add_titular.php?error_image=true"</script>';
  }
?>
