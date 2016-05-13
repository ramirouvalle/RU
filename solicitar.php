<?php
	include 'seguridad.php';

	$solicitante = $_SESSION['usuario'];
	$anfitrion = $_GET['anfitrion'];
	$id_ruta = $_GET['id_ruta'];

	include "conexion.php";
	$query = mysql_query("INSERT INTO solicitudes (ruta, anfitrion, solicitante) VALUES ('$id_ruta', '$anfitrion', '$solicitante')", $conexion) 
	or die ("Problema al insertar los datos: ".mysql_error());
	mysql_close($conexion);

	echo json_encode($query);
?>