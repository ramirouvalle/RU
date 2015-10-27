<?php 
	$matricula = $_POST['matricula'];
	$usuario = $_POST['usuario'];
	$mail = $_POST['mail'];
	$pass = $_POST['r-pass'];	

	$verificacion = strlen($matricula) * strlen($usuario) *strlen($mail) * strlen($pass);

	if($verificacion > 0){
		include("conexion.php");
		mysql_query("INSERT INTO usuarios (user, pass, matricula, correo) VALUES ('$usuario', '$pass', '$matricula', '$mail')", $conexion);
		mysql_close($conexion);
		echo "Usuario Registrado";
		//header("Location: maps.html");
	}else{
		echo "Complete todo el formulario";
	}



?>
