<?php include 'seguridad.php';?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script>
    	window.destinations = {
            universidad: [25.7238862, -100.31285739999998],
            mederos: [25.61415077, -100.28184055999998],
            hospital: [25.69185015, -100.34884213999999]
        };

    	function solicitarRuta(id_ride){
    		$.getJSON('pedirRuta.php',
    		{
    			id: id_ride
    		},
    		function(data){
    			$.each(data, function(index, route) {
    				if(route.destino_x == destinations.universidad[0] && route.destino_y == destinations.universidad[1]){
		                destino = "Ciudad Universitaria";
		            }else if(route.destino_x == destinations.mederos[0] && route.destino_y == destinations.mederos[1]){
		                destino = "Mederos";
		            }else if(route.destino_x == destinations.hospital[0] && route.destino_y == destinations.hospital[1]){
		                destino = "Hospital";
		            }
    				document.getElementById("info_titulo").innerHTML = route.nom_ruta;
    				document.getElementById("info_anfitrion").innerHTML = "Anfitrión: "+route.anfitrion;
    				document.getElementById("info_origen").innerHTML = "Punto de partida: "+route.ubicacion;
    				document.getElementById("info_destino").innerHTML = "Destino: "+ destino;
					document.getElementById("info_dias").innerHTML = "Dias: "+route.dias;
					document.getElementById("info_horario").innerHTML = "Hora: "+route.horario;
    			});
    		});
            document.getElementById("ventana").style.display = "block";
        }
        function cerrarSolicitud(){
            document.getElementById('ventana').style.display ="none";
        }
    </script>
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
	<section id="ventana">
		<section id="cont_ventana">
			<nav class="nav_ventana">
				<h1>Detalle del ride</h1>
				<a href="#" onclick="cerrarSolicitud();">Cerrar</a>
			</nav>
			<section id="map_ventana"></section>
			<section id="info_ventana">
				<h3 id="info_titulo"></h3>
				<p id="info_anfitrion"></p>
				<p id="info_origen"></p>
				<p id="info_destino"></p>
				<br>
				<h3>Dias y horarios</h3>
				<p id="info_dias"></p>
				<p id="info_horario"></p>
				<br>
				<a href="#">Solicitar</a>
				<section class="comments">
					<h3>Comentarios</h3><br>
					<h4>Titulo comentario 1</h4>
					<p>Este es el comentario 1</p>
					<h4>Titulo comentario 2</h4>
					<p>Este es el comentario 2</p>
					<h4>Titulo comentario 3</h4>
					<p>Este es el comentario 3</p>
				</section>
			</section>
		</section>
	</section>
</body>
</html>