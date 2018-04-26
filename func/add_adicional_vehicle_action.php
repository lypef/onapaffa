<?php
session_start();
if ($_SESSION['add_adicional'] == 0)
{
    echo '<script>location.href = "../manager.php?nopermitido=true"</script>';
}else
{
  error_reporting(0);
  require_once 'db.php';
  session_start();
  $userid = $_SESSION['usuario'];

  $vehiculo = $_POST['vehiculo'];
  $nombre = $_POST['nombre'];
  $domicilio = $_POST['domicilio'];
  $cp = $_POST['cp'];
  $telefono = $_POST['telefono'];
  $titular = $_POST['titular'];
  $suc = $_POST['sucursal'];

  $foto=$_FILES["foto"]["name"];
  $ruta=$_FILES["foto"]["tmp_name"];
  $nameimg = 'adicional'.date("YmdHis");
  $destino="../fotografias/".$nameimg.".jpg";
  $ruta_foto="fotografias/".$nameimg.".jpg";

  $conn = mysqli_connect($host,$user,$password,$db);
  $sql = "SELECT id FROM adicionales where  vehiculo = $vehiculo";
  $result = mysqli_query($conn,$sql);
  $NumAdcionales = mysqli_num_rows($result);

  $log = 'se agrego adicional: '.$nombre.'. al vehiculo no: '.$vehiculo. '. titular: '.ReturnNameTitular($titular);

  if ($NumAdcionales < 5)
  {
      if ($foto)
      {
        if (copy($ruta,$destino))
        {
          mysql_query("insert into adicionales (vehiculo,nombre,domicilio, cp	, telefono, foto, titular, atendio, sucursal)
                    values ('$vehiculo', '$nombre', '$domicilio', '$cp', '$telefono', '$ruta_foto', '$titular', '$userid', '$suc')");
          if (mysql_affected_rows() > 0)
          {
            AddLog($log);
            echo '<script>location.href = "../gest_vehicles.php?pagina=1&success=true"</script>';
          }else {
            echo '<script>location.href = "../gest_vehicles.php?pagina=1&error=true"</script>';
          }
        }else {
          echo '<script>location.href = "../gest_vehicles.php?pagina=1&error_image=true"</script>';
        }
      }else {
        mysql_query("insert into adicionales (vehiculo,nombre,domicilio, cp	, telefono, foto, titular, atendio, sucursal)
                  values ('$vehiculo', '$nombre', '$domicilio', '$cp', '$telefono', 'Ninguna', '$titular', '$userid', '$suc')");
        if (mysql_affected_rows() > 0)
        {
          AddLog($log);
          echo '<script>location.href = "../gest_vehicles.php?pagina=1&success=true"</script>';
        }else {
          echo '<script>location.href = "../gest_vehicles.php?pagina=1&error=true"</script>';
        }
      }

  }else {
      echo '<script>location.href = "../gest_vehicles.php?pagina=1&adicionalno=true"</script>';
  }
}
?>
