<?php
	include "conexion.php";
	$query = mysql_query("SELECT * FROM `rutas` ORDER BY id_ruta DESC LIMIT 5");
	$to_encode = array();
	while ($fila = mysql_fetch_assoc($query)) {
	    $to_encode[] = $fila;
	}
	$routesJSON = json_encode($to_encode);
	$routes = json_decode($routesJSON);
	
	
	for ($i=0; $i < count($routes) ; $i++) { 
		$route = $routes[$i];	
		for ($j=0; $j < count($route) ; $j++) { 
			$id_ruta = $route->id_ruta;
			$nom_ruta = $route->nom_ruta;
			$destino_x = $route->destino_x;
			$destino_y = $route->destino_y;
			
			if($destino_x == 25.7238862 && $destino_y == -100.31285739999998){
				$destino = "Ciudad Universitaria";
				$destinoCSS = "universidad";
			}else if($destino_x == 25.61415077 && $destino_y == -100.28184055999998){
				$destino = "Mederos";
				$destinoCSS = "mederos";
			}else if($destino_x == 25.69185015 && $destino_y == -100.34884213999999){
				$destino = "Hospital";
				$destinoCSS = "hospital";
			}

			echo "<div class='ride'>".
			 	"<a href='#' onclick='solicitarRuta(".$id_ruta.")'>".
			 		"<h4>".$nom_ruta."</h4>".
			 	"</a>".
			 	"<div class='destino ".$destinoCSS."'>".$destino."</div>".
			 	"</div>";
		}
	}
	
?>