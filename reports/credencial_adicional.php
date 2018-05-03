<?php

		require_once '../func/db.php';
		require_once("../dompdf/dompdf_config.inc.php");
		$conexion=mysql_connect($host,$user,$password);
		mysql_select_db($db,$conexion);
		if (isset($_GET["id"]))
		{
				$id = $_GET["id"];
		}

$codigoHTML='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style>
.round100 {
  width: 100px;
  height: 100px;
  background-size: cover;
  background-position: top center;
  border-radius: 50%;
	border: black 1px solid;
	border-color: LimeGreen;
}

.round80 {
  width: 80px;
  height: 80px;
  background-size: cover;
  background-position: top center;
  border-radius: 50%;
	border: black 1px solid;
	border-color: LimeGreen;
}

.contenedor{
    position: relative;
    display: inline-block;
    text-align: center;
}

.texto-nombre{
    position: absolute;
    top: 10px;
    left: 10px;
}
.centrado{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte</title>
</head>
<body>

';

$sql=mysql_query("SELECT a.nombre, v.f_expedicion, v.f_vencimiento, a.foto, v.serie, v.tipo, v.modelo, v.marca, v.cilindros, v.color, v.engomado, v.foto, v.linea FROM adicionales a, vehiculos v WHERE a.vehiculo = v.id and a.id = $id ");
while($r=mysql_fetch_array($sql)){
	$nombre = $r[0];
	$expedicion = $r[1];
	$vencimiento = $r[2];
	$f_titular = $r[3];
	$serie = $r[4];
	$tipo = $r[5];
	$modelo = $r[6];
	$marca = $r[7];
	$cilindros = $r[8];
	$color = $r[9];
	$engomado = $r[10];
	$f_vehiculo = $r[11];
	$linea = $r[12];
}
$codigoHTML.='
<div class="contenedor">
	<img src="../anverso.jpg" height="204" width="325">&nbsp;
	<img src="../reverso.jpg" height="204" width="325">
  <div style="
	position: absolute;
	top: 62px;
	left: 135px;
	font-size: .5em;">'.$nombre.'</div>

	<div style="
	position: absolute;
	top: 105px;
	left: 25px;
	font-size: .7em;
	font-family: Arial, Helvetica, sans-serif;
	background-color: LimeGreen;
	">EXPEDICION: '.$expedicion.'</div>

	<div style="
	position: absolute;
	top: 122px;
	left: 25px;
	font-size: .7em;
	font-family: Arial, Helvetica, sans-serif;
	background-color:LimeGreen;
	color: red;
	">VENCIMIENTO: '.$vencimiento.'</div>

	<div style="
	position: absolute;
	top: 105px;
	left: 245px;
	"><img class="round80" src="../'.$f_titular.'" ></div>

	<div style="
	position: absolute;
	top: 8px;
	left: 372px;
	font-size: .7em;
	font-family: Arial, Helvetica, sans-serif;
	color: red;
	">No. Engomado: '.$engomado.'</div>

	<div style="
	position: absolute;
	top: 26px;
	left: 372px;
	font-size: .7em;
	font-family: Arial, Helvetica, sans-serif;
	color: red;
	">Modelo: '.$modelo.'</div>

	<div style="
	position: absolute;
	top: 43px;
	left: 372px;
	font-size: .7em;
	font-family: Arial, Helvetica, sans-serif;
	color: red;
	">Marca: '.$marca.'</div>

	<div style="
	position: absolute;
	top: 60px;
	left: 372px;
	font-size: .7em;
	font-family: Arial, Helvetica, sans-serif;
	color: red;
	">Linea: '.$linea.'</div>

	<div style="
	position: absolute;
	top: 78px;
	left: 372px;
	font-size: .7em;
	font-family: Arial, Helvetica, sans-serif;
	color: red;
	">Tipo: '.$tipo.'</div>

	<div style="
	position: absolute;
	top: 96px;
	left: 372px;
	font-size: .7em;
	font-family: Arial, Helvetica, sans-serif;
	color: red;
	">Serie: '.$serie.'</div>

	<div style="
	position: absolute;
	top: 9px;
	left: 544px;
	"><img class="round100" src="../'.$f_vehiculo.'" ></div>

</div>
</body>
</html>';
$codigoHTML=utf8_encode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->set_paper('letter', '');
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("Credencial".$id.".pdf");
?>
