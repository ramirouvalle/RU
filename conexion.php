<?php
	$host = "mysql3.000webhost.com";
	$user = "a8039429_master";
	$pw = "comer123";
	$db = "a8039429_rides";

	$conexion = mysql_connect($host, $user, $pw) or die("Problemas al conectar");
	mysql_select_db($db, $conexion) or die("problema al conectar la bd");
?>