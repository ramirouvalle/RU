<?php
	session_start();

	$l_user = $_POST['user'];
	$l_pass = $_POST['pass'];

	include("conexion.php");

	$query = mysql_query("SELECT * FROM usuarios WHERE user = '$l_user' AND pass = '$l_pass' ", $conexion) or die("Problema en la consulta: ".mysql_error());
	
	if ($reg = mysql_fetch_array($query)) {
		//$_SESSION['autentica'] = "yes";
		$_SESSION['sesionini'] = $reg['user'];
		header("Location: maps.html");
	}else{
		echo "Usuario o contraseña incorrecta";
	}
	
	mysql_close($conexion);
?>