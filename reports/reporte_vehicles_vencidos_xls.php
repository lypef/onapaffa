<?php
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=reporte_engomados_vencidos.xls");

	require_once '../func/db.php';
	$conexion=mysql_connect($host,$user,$password);
	mysql_select_db($db,$conexion);
?>
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
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td colspan="7" bgcolor="red"><CENTER><strong>REPORTE DE ENGOMADOS VENCIDOS</strong></CENTER></td>
  </tr>
  <tr bgcolor="">
    <td><strong><center>NO.</center></strong></td>
		<td><strong>TITULAR</strong></td>
    <td><strong><center>ENGOMADO</center></strong></td>
    <td><strong><center>CARACTERISTICAS</center></strong></td>
    <td><strong><center>VENCIMIENTO</center></strong></td>
    <td><strong><center>ESTATUS</center></strong></td>
    <td><strong><center>SUCURSAL</center></strong></td>
  </tr>
	<tr>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
	</tr>';
<?php
$sql=mysql_query("SELECT v.id, t.nombre, v.serie, v.tipo, v.modelo, v.marca, v.cilindros, v.color, v.engomado, v.f_expedicion, v.f_vencimiento, REPLACE(REPLACE(v.estatus, 0, 'VENCIDO'), 1, 'VIGENTE'), v.foto, t.id, s.nombre, v.linea FROM vehiculos v, titulares t, sucursales s where v.titular = t.id and v.sucursal = s.id and v.estatus = 0 ORDER BY v.f_vencimiento desc");
while($res=mysql_fetch_array($sql)){
echo'
	<tr>
		<td><center>'.$res[0].'</center></td>
		<td>'.$res[1].'</td>
		<td><center>'.$res[8].'</center></td>
		<td><center>SERIE: '.$res[2].', TIPO: '.$res[3].', MODELO: '.$res[4].', MARCA: '.$res[5].', CILINDROS: '.$res[6].', COLOR: '.$res[7].', LINEA: '.$res[15].'</center></td>
		<td><center>'.$res[10].'</center></td>
		<td><center>'.$res[11].'</center></td>
    <td><center>'.$res[14].'</center></td>
	</tr>
	<tr>
		<td><hr></td>
		<td><hr></td>
    <td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
	</tr>';

}
?>
</table>
<footer>
  <p>Software y mas: <a href="http://www.cyberchoapas.com"> www.cyberchoapas.com</a></p>
</footer>
</body>
</html>
