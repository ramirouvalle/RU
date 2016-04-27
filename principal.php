<?php include 'seguridad.php';?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<!-- HEADER -->
	<?php include 'snippets/header.html';?>
	<section id="contenedor">
		<!-- MENU -->
		<?php include 'snippets/menu.html';?>
		<div id="central">
			<div class="bloques bloque-1">
				<div class="title">
					<h2>Ultimos rides</h2>
				</div>
				<div class="show_rides">
					<?php include 'new_rides.php';?>
				</div>
			</div>
			<div class="bloques bloque-2">
				<div class="title">
					<h2>Ultimos comentarios</h2>
				</div>
				<article id="calificaciones">
					<article class="a-calificacion">
						<p>Muy puntual y muy buen trato</p>
					</article>
					<article class="a-calificacion">
						<p>Se demoro un poco pero llegamos bien<p>
					</article>
					<article class="a-calificacion">
						<p>Acordamos un punto cercano pero el usuario no vino a recojerme</p>
					</article>
					<article class="a-calificacion">
						<p>Todo muy bien, lo recomiendo</p>
					</article>
				</article>
			</div>
			<div class="bloques bloque-3">
				<div class="title">
				</div>
			</div>
		</div>
	</section>
</body>
</html>