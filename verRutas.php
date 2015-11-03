<?php
	include("conexion.php");
	$query = mysql_query("SELECT * FROM rutas", $conexion) or die("Problema en la consultax: ".mysql_error());
	$cont = 0;
	while($reg = mysql_fetch_array($query)){
		//$cont++;
		$id = $reg['id_ruta'] - 1;
		echo "<div id='elem' class='elementos'>";
		echo "<a href='#' onclick='pasarInfo($id); muestraInfo();'>";
		echo "<h1>".$reg['nom_ruta']."</h1>";
		echo "</a>";
		echo "<p>".$reg['anfitrion']."</p>";
		echo "<p>".$reg['ubicacion']."</p>";
		echo "<p>".$reg['horario']."</p>";
		echo "<p>".$reg['dias']."</p>";
		//echo "<p>".$reg['id_ruta']."</p>";
		echo "</div>";
	}
?>

    