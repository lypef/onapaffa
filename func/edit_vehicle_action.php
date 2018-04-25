<?php
  error_reporting(0);
  require_once 'db.php';

  $id = $_POST['id'];
  $serie = $_POST['serie'];
  $tipo = $_POST["tipo"];
  $modelo = $_POST["modelo"];
  $marca = $_POST["marca"];
  $cilindros = $_POST["cilindros"];
  $color = $_POST["color"];
  $engomado = $_POST["engomado"];
  $suc = $_POST['sucursal'];

  $foto=$_FILES["foto"]["name"];
  $ruta=$_FILES["foto"]["tmp_name"];
  $nameimg = 'vehiculo_'.date("YmdHis");
  $destino="../fotografias/".$nameimg.".jpg";
  $ruta_foto="fotografias/".$nameimg.".jpg";

  $log = 'se actualizo iniformacion vehiculo no. '.$id;

  if ($foto)
  {
    if (copy($ruta,$destino))
    {
      if ($suc > 0)
      {
        mysql_query("update vehiculos set serie = '$serie', tipo = '$tipo', modelo = '$modelo', marca = '$marca', cilindros = '$cilindros', color = '$color', engomado = '$engomado', foto = '$ruta_foto', sucursal = '$suc' where id = '$id' ");
      }else {
        mysql_query("update vehiculos set serie = '$serie', tipo = '$tipo', modelo = '$modelo', marca = '$marca', cilindros = '$cilindros', color = '$color', engomado = '$engomado', foto = '$ruta_foto' where id = '$id' ");
      }

      if (mysql_affected_rows() > 0)
      {
        AddLog($log);
        echo '<script>location.href = "../gest_vehicles.php?pagina=1?&update=true"</script>';
      }else {
        echo '<script>location.href = "../gest_vehicles.php?pagina=1?&noupdate=true"</script>';
      }
    }else {
      echo '<script>location.href = "../gest_vehicles.php?pagina=1?&noupdate=true"</script>';
    }
  }else {
    if ($suc > 0)
    {
      mysql_query("update vehiculos set serie = '$serie', tipo = '$tipo', modelo = '$modelo', marca = '$marca', cilindros = '$cilindros', color = '$color', engomado = '$engomado', sucursal = '$suc' where id = '$id' ");
    }else {
      mysql_query("update vehiculos set serie = '$serie', tipo = '$tipo', modelo = '$modelo', marca = '$marca', cilindros = '$cilindros', color = '$color', engomado = '$engomado' where id = '$id' ");
    }

    if (mysql_affected_rows() > 0)
    {
      AddLog($log);
      echo '<script>location.href = "../gest_vehicles.php?pagina=1?&update=true"</script>';
    }else {
      echo '<script>location.href = "../gest_vehicles.php?pagina=1?&noupdate=true"</script>';
    }
  }
?>
