<?php
	$destino = $_POST['destino'];
	$ubicacion = $_POST['ubicacion'];
	$titulo = $_POST['titulo'];
	$descripcion = $_POST['descripcion'];
	$horario = $_POST['horario'];
	@$arrDias = $_POST['dias'];

	$coorDestx;
	$coorDesty;
	if($arrDias != 0){
		$ndias = count($arrDias);

		$verificacion = strlen($titulo) * strlen($ubicacion) * strlen($horario) * strlen($ndias) * strlen($descripcion);
		if($verificacion > 0){
			session_start();
			if($destino == "Universidad"){
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
			mysql_query("INSERT INTO rutas (nom_ruta, anfitrion, destino_x, destino_y, ubicacion, dias, horario) VALUES ('$titulo', '$user', '$coorDestx', '$coorDesty', '$ubicacion', '$diasBD', '$horario')", $conexion) or die("Problema en la consultax: ".mysql_error());
			mysql_close($conexion);
			?>
			<script type="text/javascript">alert("La ruta se guardo correctamente.")</script>
			<?php
			header("Location: mapa.php");
		}else{
			echo "Complete el formulario.";
		}
	}else{
		echo "Seleccione los dias que realiza esta ruta";	
	}
?>