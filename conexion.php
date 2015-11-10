<?php
	$host = "127.0.0.1";
	$user = "root";
	$pw = "";
	$db = "rides";

	@$conexion = mysql_connect($host, $user, $pw) or die("Problemas al conectar");
	mysql_select_db($db, $conexion) or die("problema al conectar la bd");		
?>
