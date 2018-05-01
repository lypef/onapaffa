<?php
session_start();
if ($_SESSION['add_vehicle'] == 0)
{
    echo '<script>location.href = "../manager.php?nopermitido=true"</script>';
}else
{
  error_reporting(0);
  $userid = $_SESSION['usuario'];

  require_once 'db.php';

  $suc = $_POST['sucursal'];
  $titular = $_POST['titular'];
  $serie = $_POST['serie'];
  $tipo = $_POST['tipo'];
  $modelo = $_POST['modelo'];
  $marca = $_POST['marca'];
  $cilindros = $_POST['cilindros'];
  $color = $_POST['color'];
  $engomado = $_POST['engomado'];
  $linea = $_POST['linea'];
  $f_expedicion = str_replace("/","-",$_POST['f_expedicion']);
  $f_vencimiento = str_replace("/","-",$_POST['f_vencimiento']);

  if ($_POST['estatus'])
  {
      $estatus = 1;
  }else {
      $estatus = 0;
  }

  $foto=$_FILES["foto"]["name"];
  $ruta=$_FILES["foto"]["tmp_name"];
  $nameimg = 'vehiculo_'.date("YmdHis");
  $destino="../fotografias/".$nameimg.".jpg";
  $ruta_foto="fotografias/".$nameimg.".jpg";

  $log = 'alta vehiculo de titular '.ReturnNameTitular($titular). ' numero de usuario: '.$titular;

  if ($foto)
  {
    if (copy($ruta,$destino))
    {
      mysql_query("insert into vehiculos (titular, serie, tipo, modelo, marca, cilindros, color, engomado, f_expedicion, f_vencimiento, estatus, foto, atendio, sucursal, linea)
                values ('$titular', '$serie', '$tipo', '$modelo', '$marca', '$cilindros', '$color', '$engomado', '$f_expedicion', '$f_vencimiento', '$estatus', '$ruta_foto', '$userid', '$suc', '$linea')");
      if (mysql_affected_rows() > 0)
      {
        AddLog($log);
        echo '<script>location.href = "../add_vehicle.php?success=true"</script>';
      }else {
        echo '<script>location.href = "../add_vehicle.php?error=true&serie='.$serie.'&tipo='.$tipo.'&modelo='.$modelo.'&marca='.$marca.'&cilindros='.$cilindros.'&color='.$color.'&engomado='.$engomado.'&f_expedicion='.$f_expedicion.'&f_vencimiento='.$f_vencimiento.'&titular='.$titular.'&sucursal='.$suc.'"</script>';
      }
    }else {
        echo '<script>location.href = "../add_vehicle.php?error_image=true&serie='.$serie.'&tipo='.$tipo.'&modelo='.$modelo.'&marca='.$marca.'&cilindros='.$cilindros.'&color='.$color.'&engomado='.$engomado.'&f_expedicion='.$f_expedicion.'&f_vencimiento='.$f_vencimiento.'&titular='.$titular.'&sucursal='.$suc.'"</script>';
    }
  }else {
    mysql_query("insert into vehiculos (titular, serie, tipo, modelo, marca, cilindros, color, engomado, f_expedicion, f_vencimiento, estatus, foto, atendio, sucursal, linea) values ('$titular', '$serie', '$tipo', '$modelo', '$marca', '$cilindros', '$color', '$engomado', '$f_expedicion', '$f_vencimiento', '$estatus', 'ninguna', '$userid', '$suc', '$linea')");
    if (mysql_affected_rows() > 0)
    {
      AddLog($log);
      echo '<script>location.href = "../add_vehicle.php?success=true"</script>';
    }else {
      echo '<script>location.href = "../add_vehicle.php?error=true&serie='.$serie.'&tipo='.$tipo.'&modelo='.$modelo.'&marca='.$marca.'&cilindros='.$cilindros.'&color='.$color.'&engomado='.$engomado.'&f_expedicion='.$f_expedicion.'&f_vencimiento='.$f_vencimiento.'&titular='.$titular.'&sucursal='.$suc.'"</script>';
    }
  }
}
?>
