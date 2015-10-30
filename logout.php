<?php
	session_start();
	//echo "Salio de la Sesion..! ".var_dump($_SESSION)."<br>";
	$_SESSION = array();
	//echo "Salio de la Sesion..! ".var_dump($_SESSION)."<br>";
	session_unset();
	//echo "Salio de la Sesion..! ".var_dump($_SESSION)."<br>";
	header("Location: index.html");
?>