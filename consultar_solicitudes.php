<?php
	$anfitrion = $_SESSION['usuario'];

	include "conexion.php";
	$query = mysql_query("SELECT COUNT(*) AS nSolicitudes FROM solicitudes WHERE anfitrion = '$anfitrion' AND notificado = 0", $conexion)
	or die ("Problema al consultar las solicitudes: ".mysql_error());

	mysql_close($conexion);

	if ($fila = mysql_fetch_assoc($query)) {
		if($fila["nSolicitudes"] > 0){
			echo "<span class='notification'>".$fila["nSolicitudes"]."</span>";
		}
	}
?>