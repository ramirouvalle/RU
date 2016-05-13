<?php
	@include "seguridad.php";
	$anfitrion = $_SESSION['usuario'];

	include "conexion.php";
	$query = mysql_query("SELECT * FROM rutas WHERE anfitrion = '$anfitrion'", $conexion)
	or die ("Problema al consultar los rides: ".mysql_error());

	$to_encode = array();
	while ($fila = mysql_fetch_assoc($query)) {
	    $to_encode[] = $fila;
	}
	mysql_close($conexion);
	echo json_encode($to_encode);
?>