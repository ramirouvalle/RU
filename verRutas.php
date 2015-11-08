<?php
	include("conexion.php");
	$query = mysql_query("SELECT * FROM rutas", $conexion) or die("Problema en la consultax: ".mysql_error());
	$cont = 0;
	while($reg = mysql_fetch_array($query)){
		//$id = $reg['id_ruta'] - 1;
		echo "<div id='elem' class='elementos'>";
		echo "<a href='#' onclick='verRuta($cont);'>";
		echo "<h1>".$reg['nom_ruta']."</h1>";
		echo "</a>";
		echo "<p>".$reg['anfitrion']."</p>";
		echo "<p>".$reg['ubicacion']."</p>";

		/* CONVERTIR COORDENADAS A PALABRAS */
		if($reg['destino_x'] == 25.7238862 && $reg['destino_y'] == -100.31285739999998){
			echo "<p>Ciudad universitaria</p>";
		}else if($reg['destino_x'] == 25.61415077 && $reg['destino_y'] == -100.28184056){
			echo "<p>Mederos</p>";
		}else if($reg['destino_x'] == 25.69185015 && $reg['destino_y'] == -100.34884214){
			echo "<p>Hospital</p>";
		}
		//echo "<p>".$reg['destino_x'].", ".$reg['destino_y']."</p>";
		echo "<p>".$reg['horario']."</p>";
		echo "<p>".$reg['dias']."</p>";
		echo "</div>";
		$cont++;
	}
?>

    