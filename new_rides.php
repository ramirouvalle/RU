<?php
	include "conexion.php";
	$query = mysql_query("SELECT * FROM `rutas` ORDER BY id_ruta DESC LIMIT 5");
	$to_encode = array();
	while ($fila = mysql_fetch_assoc($query)) {
	    $to_encode[] = $fila;
	}
	//print_r($to_encode);
	$routesJSON = json_encode($to_encode);
	$routes = json_decode($routesJSON);
	
	echo "<ul>";
	for ($i=0; $i < count($routes) ; $i++) { 
		$route = $routes[$i];	
		for ($j=0; $j < count($route) ; $j++) { 
			$nom_ruta = $route->nom_ruta;
			 echo "<a href='#'><li><h4>".$nom_ruta."</h4></li></a>";
		}
	}
	echo "</ul>";
?>