<?php
  error_reporting(0);
  require_once 'db.php';

  $id = $_POST['id'];
  $f_expedicion = str_replace("/","-",$_POST['f_expedicion']);
  $f_vencimiento = str_replace("/","-",$_POST['f_vencimiento']);


  mysql_query("update vehiculos set f_expedicion = '$f_expedicion', f_vencimiento = '$f_vencimiento' where id = '$id' ");
  if (mysql_affected_rows() > 0)
  {
    echo '<script>location.href = "../gest_vehicles.php?pagina=1?&engomado=true"</script>';
  }else {
    echo '<script>location.href = "../gest_vehicles.php?pagina=1?&noengomado=true"</script>';
  }
?>
