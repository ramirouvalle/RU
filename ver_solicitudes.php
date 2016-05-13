<?php
	@include "seguridad.php";
	$anfitrion = $_SESSION['usuario'];

	include "conexion.php";
	$query = mysql_query("SELECT id, nom_ruta, solicitante FROM solicitudes INNER JOIN rutas ON id_ruta = ruta WHERE solicitudes.anfitrion = '$anfitrion' AND notificado = 0", $conexion)
	or die ("Problema al consultar las solicitudes: ".mysql_error());

	echo "<section id='notification-box'>";
	while($fila = mysql_fetch_assoc($query)) {
		echo "<a href='#' onclick='selection(".$fila["id"].");'>";
		echo "<article class='box'>";
		echo "<p>El usuario <span>".$fila["solicitante"]."</span> te ha solicitado un ride en <span>".$fila["nom_ruta"]."</span></p>"; 
		echo "</article>";	
		echo "</a>";
	}
	mysql_close($conexion);
	echo "</section>";
?>