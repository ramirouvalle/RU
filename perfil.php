<html>
<head>
	<title>Perfil del usuario</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<!-- HEADER -->
	<?php include 'snippets/header.html';?>
	<section id="contenedor">
		<!-- MENU -->
		<?php include 'snippets/menu.html';?>
		<section id="b-central">
			<section class="bloques b-perfil">
				<img src="images/bg_perfil.jpg">
				<h2>Ramiro Uvalle</h2>
				<p class="p-perfil-desc">Alguna descripcion que el usuario desee poner en este apartado</p>
				<p>Universidad: FIME</p>
				<p>Rides disponibles: 3</p>
				<p>Nivel: Medio</p>
				<a href="#">Contactar</a>
				<a href="#">Editar perfil</a>
			</section>	
			<section class="b-cont">
				<section class="bloques b-int b-reputacion">
					<h3>Reputación</h3>
					<article>
						<img src="images/business.png">
						<p>Porcentaje de calificaciones</p>
						<p>Positivas: 73%</p>
						<p>Negativas: 27%</p>
					</article>
				</section>
				<section class="bloques b-int b-calificaciones">
					<h3>Calificaciones</h3>
					<article class="a-calificacion cal-pos">
						<p>Muy puntual y muy buen trato</p>
					</article>
					<article class="a-calificacion cal-neu">
						<p>Se demoro un poco pero llegamos bien<p>
					</article>
					<article class="a-calificacion cal-neg">
						<p>Acordamos un punto cercano pero el usuario no vino a recojerme</p>
					</article>
					<article class="a-calificacion cal-pos">
						<p>Todo muy bien, lo recomiendo</p>
					</article>
				</section>
				<section class="bloques b-int b-rides">
					<h3>Mas rides del usuario</h3>
					<article class=" a-calificacion">
						<p>Guadalupe a universidad</p>
					</article>
					<article class=" a-calificacion">
						<p>Universidad a hospital</p>
					</article>
					<article class=" a-calificacion">
						<p>Guadalupe a hospital</p>
					</article>
					<article class=" a-calificacion">
						<p>Universidad a mitras</p>
					</article>
				</section>
			</section>
		</section>
	</section>
</body>
</html>