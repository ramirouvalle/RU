<?php
	$anfitrion = $_POST['anfitrion'];
	$solictante = $_POST['solicitante'];
	$ruta = $_POST['rutaname'];
	
	/*
	echo $anfitrion;
	echo $solicitante;
	echo $ruta;
	*/

	include("conexion.php");
	mysql_query("INSERT INTO solicitudes (ruta, anfitrion, solicitante, notificado) VALUES ('$ruta', '$anfitrion', '$solicitante', '0')", $conexion) or die("Problema en la consultax: ".mysql_error());
?>