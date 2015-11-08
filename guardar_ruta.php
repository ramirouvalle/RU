<?php

    function retJSON($ubicacion) {
        $ubicacion = urlencode($ubicacion);
        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=";
        $json = file_get_contents($url.$ubicacion);
        $obj = json_decode($json);
        $json_return = json_encode($obj->{'results'}[0]->{'geometry'}->{'location'});
        return $json_return;
    }

	$destino = $_POST['destino'];
	$ubicacion = $_POST['ubicacion'];
	$titulo = $_POST['titulo'];
	$descripcion = $_POST['descripcion'];
	$horario = $_POST['horario'];
	$arrDias = $_POST['dias'];
    $coorOrigx = retJSON($ubicacion);
    $coorOrigy = retJSON($ubicacion);

    $coorOrigx = json_decode($coorOrigx)->{'lat'};
    $coorOrigy = json_decode($coorOrigy)->{'lng'};

	$coorDestx;
	$coorDesty;
	if($arrDias != 0){
		$ndias = count($arrDias);

		$verificacion = strlen($titulo) * strlen($ubicacion) * strlen($horario) * strlen($ndias) * strlen($descripcion);
		if($verificacion > 0){
			session_start();
			if($destino == "Ciudad universitaria"){
				$coorDestx = "25.7238862";
				$coorDesty = "-100.31285739999998";
			}else if($destino == "Mederos"){
				$coorDestx = "25.61415077";
				$coorDesty = "-100.28184056";
			}else if($destino == "Hospital"){
				$coorDestx = "25.69185015";
				$coorDesty = "-100.34884214";
			}
			for($n = 0 ; $n<$ndias ; $n++){
				if($n == 0){
					$diasBD = $arrDias[$n];
				}else{
					$diasBD = $diasBD.", ".$arrDias[$n];	
				}
			}
			include("conexion.php");
			$user = $_SESSION['usuario'];
            if (!isset($user)) {
                $user = 'ax';
            }
            
			mysql_query("INSERT INTO rutas (nom_ruta, anfitrion, origen_x, origen_y, destino_x, destino_y, ubicacion, dias, horario) VALUES ('$titulo', '$user', '$coorOrigx', '$coorOrigy', '$coorDestx', '$coorDesty', '$ubicacion', '$diasBD', '$horario')", $conexion) or die("Problema en la consultax: ".mysql_error());
			mysql_close($conexion);
			
			header("Location: mapa.php");
		}else{
			echo "Complete el formulario.";
		}
	}else{
		echo "Seleccione los dias que realiza esta ruta";	
	}
?>
