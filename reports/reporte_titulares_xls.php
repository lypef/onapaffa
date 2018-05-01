<?php

		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=Reporte_titulares.xls");

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
    <td colspan="6" bgcolor="skyblue"><CENTER><strong>REPORTE DE TITULARES</strong></CENTER></td>
  </tr>
  <tr bgcolor="">
    <td><strong><center>NO.</center></strong></td>
		<td><strong>NOMBRE</strong></td>
    <td><strong>DOMICILIO</strong></td>
    <td><strong><center>CP</center></strong></td>
    <td><strong><center>TELEFONO</center></strong></td>
    <td><strong><center>SUCURSAL</center></strong></td>
  </tr>
	<tr>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
		<td><hr></td>
	</tr>';

<?php

$sql=mysql_query("SELECT t.fotografia, t.nombre, t.domicilio, t.cp, t.telefono, s.nombre, t.id FROM titulares t, sucursales s WHERE t.sucursal = s.id");
while($res=mysql_fetch_array($sql)){
echo '
	<tr>
		<td>'.$res[6].'</td>
		<td>'.$res[1].'</td>
		<td>'.$res[2].'</td>
		<td><center>'.$res[3].'</center></td>
		<td><center>'.$res[4].'</center></td>
		<td><center>'.$res[5].'</center></td>
	</tr>
	<tr>
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
