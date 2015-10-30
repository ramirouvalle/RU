<?php
	include("conexion.php");
	$query = mysql_query("SELECT * FROM rutas", $conexion) or die("Problema en la consultax: ".mysql_error());
	while($reg = mysql_fetch_array($query)){
		echo "<div id='elem'>";
		echo "<a href='#'>";
		echo "<h1>".$reg['nom_ruta']."</h1>";
		echo "</a>";
		echo "<p>".$reg['anfitrion']."</p>";
		echo "<p>".$reg['origen_x']."</p>";
		echo "<p>".$reg['origen_y']."</p>";
		echo "</div>";
	}
?>

    