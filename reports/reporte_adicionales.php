<?php

		require_once '../func/db.php';
		require_once("../dompdf/dompdf_config.inc.php");
		$conexion=mysql_connect($host,$user,$password);
		mysql_select_db($db,$conexion);


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
}
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte</title>
</head>
<body>
<div style="align: left;">
	<img src="../images/logo.jpg">
</div>
<p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td colspan="9" bgcolor="skyblue"><CENTER><strong>REPORTE DE ADICIONALES</strong></CENTER></td>
  </tr>
  <tr bgcolor="">
    <td><strong><center>NO.</center></strong></td>
		<td><strong><center>VEHICULO</center></strong></td>
    <td><strong><center>F. TITULAR</center></strong></td>
		<td><strong>TITULAR</strong></td>
    <td><strong><center>F. ADICIONAL</center></strong></td>
		<td><strong><center>ADICIONAL</center></strong></td>
		<td><strong><center>ESTATUS</center></strong></td>
    <td><strong><center>VENCIMIENTO</center></strong></td>
		<td><strong><center>INFORMACION</center></strong></td>
  </tr>
	<tr>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
    <td><hr></td>
		<td><hr></td>
	</tr>';



$sql=mysql_query("SELECT a.id, v.foto, t.nombre, a.nombre, v.f_vencimiento, REPLACE(REPLACE(v.estatus, 0, 'VENCIDO'), 1, 'VIGENTE'), a.domicilio, a.cp, a.telefono, a.foto, t.fotografia, s.nombre from vehiculos v, titulares t, adicionales a, sucursales s  where a.titular = t.id and a.vehiculo = v.id and a.sucursal = s.id ORDER BY v.id");
while($res=mysql_fetch_array($sql)){
$codigoHTML.='
	<tr>
		<td><center>'.$res[0].'</center></td>
		<td><center><img class="round100" src="../'.$res[1].'"></center></td>
		<td><center><img class="round100" src="../'.$res[10].'"></center></td>
		<td><center>'.$res[2].'</center></td>
		<td><center><img class="round100" src="../'.$res[9].'"></center></td>
		<td><center>'.$res[3].'</center></td>
		<td><center>'.$res[5].'</center></td>
    <td><center>'.$res[4].'</center></td>
		<td><center>DOMICILIO:'.$res[6].', CP:'.$res[7].', TELEFONO:'.$res[8].' - , SUCURSAL:'.$res[11].'</center></td>
	</tr>
	<tr>
		<td><hr></td>
		<td><hr></td>
    <td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
	</tr>';

}
$codigoHTML.='
</table>
<footer>
  <p>Software y mas: <a href="http://www.cyberchoapas.com"> www.cyberchoapas.com</a></p>
</footer>
</body>
</html>';
$codigoHTML=utf8_encode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->set_paper('letter', 'landscape');
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("Reporte_adicionales.pdf");
?>
