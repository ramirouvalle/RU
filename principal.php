<?php include 'seguridad.php';?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBJywoknUVkMygQ_OvEzJWhmQq_SMFG4No&region=MX&libraries=geometry,places">
    </script>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script>
    	window.destinations = {
            universidad: [25.7238862, -100.31285739999998],
            mederos: [25.61415077, -100.28184055999998],
            hospital: [25.69185015, -100.34884213999999]
        };
        function crearMapa(location, option){
            /*** Creamos el mapa ***/
            var map = new google.maps.Map(document.getElementById('map_ventana'), {
                center: location,
                scrollwheel: false,
                zoom: 14
            });

            /*** Insertar el marcador de la ubicacion en el mapa ***/
            if(option == 1){ //Si se usa la geolocalizacion
                var options = { 
                    position: location,
                    title: "Tu ubicación"
                };
                var marker = new google.maps.Marker(options);
                marker.setMap(map);
            }
            return map;
        }
        function detectarUbicacion(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    /*** Si se permite la deteccion automatica de la ubicacion ***/ 
                    miUbicacion ={ //Ubicacion real
                        lat: position.coords.latitude, 
                        lng: position.coords.longitude
                    }; 
                    crearMapa(miUbicacion, 1); 
                }, function() {
                    /*** Si se bloquea la deteccion automatica de la ubicacion ***/
                    miUbicacion ={ //Ubicacion UANL
                        lat: destinations.universidad[0], 
                        lng: destinations.universidad[1]
                    }; 
                    crearMapa(miUbicacion, 2);
                });
            }else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }            
        }
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
    				document.getElementById("info_origen").innerHTML = "Punto de partida: <br>"+route.ubicacion;
    				document.getElementById("info_destino").innerHTML = "Destino: "+ destino;
					document.getElementById("info_dias").innerHTML = "Dias: "+route.dias;
					document.getElementById("info_horario").innerHTML = "Hora: "+route.horario;
					
					/* Creamos boton de solicitar */
					var capa = document.getElementById("info_ventana");
					var boton = document.getElementById("btn_solicitar");
					//Verificamos si existe o no el boton solicitar
					if (boton === undefined || boton === null) {
						//No existe 
					}else{
						//Si existe 
						//Lo removemos 
						boton.parentNode.removeChild(boton);
					}
					//Creamos boton de solicitar
					var enlace = document.createElement("a");
					enlace.setAttribute('id', 'btn_solicitar');
					enlace.setAttribute('href',"#");
					enlace.setAttribute('onclick','pedirRide('+id_ride+',"'+route.anfitrion+'");');
					enlace.innerHTML = "Solicitar";
					capa.appendChild(enlace);

					var origen = new google.maps.LatLng(route.origen_x, route.origen_y);
            		var destino = new google.maps.LatLng(route.destino_x, route.destino_y);

            		var map = crearMapa(origen, 2);

            		var directionsDisplay = new google.maps.DirectionsRenderer({
	                    map: map,
	                    polylineOptions: {
	                        strokeColor: "red"
	                    }
	                });
	                
	                var request = {
	                    origin: origen,
	                    destination: destino,
	                    travelMode: google.maps.TravelMode.DRIVING
	                };
	                
	                var directionsService = new google.maps.DirectionsService();
	                directionsService.route(request, function(response, status) {
	                    if (status == google.maps.DirectionsStatus.OK) {
	                        directionsDisplay.setDirections(response);
	                    }
	                });
    			});
    		});
            document.getElementById("ventana").style.display = "block";
        	/*detectarUbicacion();*/
        }
        function cerrarSolicitud(){
            document.getElementById('ventana').style.display ="none";
        }
        function pedirRide(id_ruta, anfitrion){
        	$.getJSON('solicitar.php',
        	{
        		anfitrion: anfitrion,
        		id_ruta: id_ruta
        	},
        	function(data) {
        		if(data == true){
        			alert("El ride se ha solicitado satisfactoriamente");
        		}
  			});
  			$("#solicitudes").load("consultar_solicitudes.php");
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
				<!--<a href="#" onclick="pedirRide()">Solicitar</a>-->
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