<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$db = "onapaffa";
	mysql_connect($host,$user,$password);
	mysql_select_db($db);

	function AddLog($contenido)
	{
		session_start();
	  $userid = $_SESSION['usuario'];
		$contenido = strtoupper($contenido);
		$date_time = date("Y-m-d H:i:s");
		mysql_query("insert into logs (user, fecha, registro) values ('$userid', '$date_time', '$contenido')");
	}

	function ReturnNameTitular ($id)
	{
		$result = mysql_query("SELECT nombre FROM titulares WHERE id = '$id'");
		while($row = mysql_fetch_array($result))
		{
			$r = $row[0];
		}
		return $r;
	}

	function ReturnNameAdicional ($id)
	{
		$result = mysql_query("SELECT nombre FROM adicionales WHERE id = '$id'");
		while($row = mysql_fetch_array($result))
		{
			$r = $row[0];
		}
		return $r;
	}

	function ReturnAddUserBool ($username)
	{
		$rr = true;
		$result = mysql_query("SELECT id FROM users WHERE username = '$username'");
		while($row = mysql_fetch_array($result))
		{
			$r = $row[0];
		}
		if ($r)
		{
			$rr = false;
		}
		return $rr;
	}
?>
