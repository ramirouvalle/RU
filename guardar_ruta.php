<?php
	$titulo = $_POST['titulo'];
	$ubicacion = $_POST['ubicacion'];
	$horario = $_POST['horario'];
	@$arrDias = $_POST['dias'];

	if($arrDias != 0){
		$ndias = count($arrDias);

		$verificacion = strlen($titulo) * strlen($ubicacion) * strlen($horario) * strlen($ndias);
		if($verificacion > 0){
			session_start();
			for($n = 0 ; $n<$ndias ; $n++){
				if($n == 0){
					$diasBD = $arrDias[$n];
				}else{
					$diasBD = $diasBD.", ".$arrDias[$n];	
				}
			}
			include("conexion.php");
			$user = $_SESSION['usuario'];
			mysql_query("INSERT INTO rutas (nom_ruta, anfitrion, ubicacion, dias, horario) VALUES ('$titulo', '$user', '$ubicacion', '$diasBD', '$horario')", $conexion) or die("Problema en la consultax: ".mysql_error());
			mysql_close($conexion);
			/*
			echo $titulo."<br>";
			echo $user."<br>";
			echo $ubicacion."<br>";
			echo $horario."<br>";
			echo $diasBD;
			*/
			?>
			<script type="text/javascript">alert("La ruta se guardo correctamente.")</script>
			<?php
			header("Location: maps.php");
		}else{
			echo "Complete el formulario.";
		}
	}else{
		echo "Seleccione los dias que realiza esta ruta";	
	}
	

	
?>