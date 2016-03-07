<?include "seguridad.php";?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="css/home.css" rel="stylesheet" type="text/css">
</head>
<body>
	<header>
		<div id="logo">
			<p>RideUniversitario</p>
		</div>
		<div id="ops_users">
			<p class="name_user">
			<?php 
                @session_start();
        	    echo @$_SESSION['usuario'];
            ?>
            </p>
            <a href="#">Mensajes</a>
            <a href="#">Perfil</a>
          	<a href="logout.php">Cerrar sesión</a>
		</div>
	</header>
	<section id="contenedor">
		<nav class="menu">
			<ul>
				<li><a href="#">Mis rides</a></li>
				<li><a href="#">Solicitudes</a></li>
				<li><a href="crear_ruta.php">Crear Ride</a></li>
				<li><a href="buscar_ride.php">Solicitar Ride</a></li>
			</ul>
		</nav>
		<div id="central">
			<div class="bloque-1"></div>
			<div class="bloque-2"></div>
			<div class="bloque-3"></div>
		</div>
	</section>
</body>
</html>