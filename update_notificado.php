<?php
	include "seguridad.php";

	$id_solicitud = $_GET['id_solicitud'];

	include "conexion.php";
	$query = mysql_query("UPDATE solicitudes SET notificado = 1 WHERE id = $id_solicitud", $conexion) 
	or die ("Problema al insertar los datos: ".mysql_error());

	mysql_close($conexion);
	echo json_encode($query);
?>