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
	border-color: #00a54f;
}

.round80 {
  width: 80px;
  height: 80px;
  background-size: cover;
  background-position: top center;
  border-radius: 50%;
	border: black 1px solid;
	border-color: #00a54f;
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
@page {
   size: 8.5cm 5.4cm;
   margin-top: 0cm;
	 margin-left: 0cm;
	 margin-right: 0cm;
   margin-bottom: 0cm;
   border: 1px solid blue;
}
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte</title>
</head>
<body>

';

$sql=mysql_query("SELECT t.nombre, v.f_expedicion, v.f_vencimiento, t.fotografia, v.serie, v.tipo, v.modelo, v.marca, v.cilindros, v.color, v.engomado, v.foto, v.linea FROM vehiculos v, titulares t WHERE v.titular = t.id and v.id = $id ");
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
<img src="../images/anverso.jpg" height="203" width="325">

<div style="
position: absolute;
top: 62px;
left: 120px;
font-size: .5em;">'.$nombre.'</div>

<div style="
position: absolute;
top: 105px;
left: 25px;
font-size: .7em;
font-style:Helvetica;
font-weight:bold;
font-color:#ffffff;
">EXPEDICION: '.$expedicion.'</div>

<div style="
position: absolute;
top: 122px;
left: 25px;
font-size: .7em;
font-style:Helvetica;
font-weight:bold;
font-color:#ffffff;
color: red;
">VENCIMIENTO: '.$vencimiento.'</div>

<div style="
position: absolute;
top: 105px;
left: 230px;
"><img class="round80" src="../'.$f_titular.'" ></div>

<img src="../images/reverso.jpg" height="203" width="325">

<div style="
position: absolute;
top: 8px;
left: 10px;
font-size: .7em;
font-family: Arial, Helvetica, sans-serif;
color: black;
">NO. ENGOMADO: '.$engomado.'</div>

<div style="
position: absolute;
top: 26px;
left: 10px;
font-size: .7em;
font-family: Arial, Helvetica, sans-serif;
color: black;
">MODELO: '.$modelo.'</div>

<div style="
position: absolute;
top: 43px;
left: 10px;
font-size: .7em;
font-family: Arial, Helvetica, sans-serif;
color: black;
">MARCA: '.$marca.'</div>

<div style="
position: absolute;
top: 60px;
left: 10px;
font-size: .7em;
font-family: Arial, Helvetica, sans-serif;
color: black;
">LINEA: '.$linea.'</div>

<div style="
position: absolute;
top: 78px;
left: 10px;
font-size: .7em;
font-family: Arial, Helvetica, sans-serif;
color: black;
">TIPO: '.$tipo.'</div>

<div style="
position: absolute;
top: 96px;
left: 10px;
font-size: .7em;
font-family: Arial, Helvetica, sans-serif;
color: black;
">SERIE: '.$serie.'</div>

<div style="
position: absolute;
top: 8.5px;
left: 195px;
"><img class="round100" src="../'.$f_vehiculo.'" ></div>

</div>
</body>
</html>';
$codigoHTML=utf8_encode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","1024M");
$dompdf->render();
$dompdf->stream("Credencial".$id.".pdf");
?>
