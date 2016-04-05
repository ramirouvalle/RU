<?php include 'seguridad.php';?>
<html>
<meta charset="UTF-8">
<head>
    <title>Buscar ride</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBJywoknUVkMygQ_OvEzJWhmQq_SMFG4No&callback=detectarUbicacion&region=MX&libraries=geometry,places">
    </script>
    <script>
        window.destinations = {
            universidad: [25.7238862, -100.31285739999998],
            mederos: [25.61415077, -100.28184055999998],
            hospital: [25.69185015, -100.34884213999999]
        };
        window.miUbicacion;

        function crearMapa(location, option){
            /*** Creamos el mapa ***/
            var map = new google.maps.Map(document.getElementById('mapa'), {
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
        function seleccionarDestino(){
            var ver = document.getElementById("cbxDestino").value;
            var destino;
            if (ver == "Seleccionar") {
                //No se selecciono
                alert("Seleccione un destino");
                destino = null;
            }else if(ver == "Ciudad universitaria"){
                destino = new google.maps.LatLng(destinations.universidad[0], destinations.universidad[1]);   
            }else if(ver == "Mederos"){
                destino = new google.maps.LatLng(destinations.mederos[0], destinations.mederos[1]);  
            }else if(ver == "Hospital"){
                destino = new google.maps.LatLng(destinations.hospital[0], destinations.hospital[1]);   
            }
            return destino;
        }

        function buscarRutasCercanas(){
            limpiarListaRutas();
            var ubicacionLatLng = new google.maps.LatLng(miUbicacion);
            var destino = seleccionarDestino();
            if (destino != null) {
                /*** Consigue las rutas que hay en la base de datos ***/
                $.getJSON('rutasdata.php',
                { 
                    destino_x: destino.lat(),
                    destino_y: destino.lng()
                },
                function(data){
                    var routes = [];
                    $.each(data, function(index, route) {
                        routes.push(
                            {
                                id: route.id_ruta,
                                anfitrion: route.anfitrion,
                                nombre: route.nom_ruta,
                                ubicacion: route.ubicacion,
                                origen: new google.maps.LatLng(route.origen_x, route.origen_y),
                                destino: new google.maps.LatLng(route.destino_x, route.destino_y),
                                horario: route.horario,
                                dias: route.dias
                            }
                        );
                    });
                    var c = 0;
                    /*** Muestro rutas cerca de mi ***/
                    routes.forEach(function(route, index) {
                        var request = {
                            origin: route.origen,
                            destination: route.destino,
                            travelMode: google.maps.TravelMode.DRIVING
                        };
                        var directionsService = new google.maps.DirectionsService();
                        
                        directionsService.route(request, function(response, status) {
                            route.polyline = new google.maps.Polyline({
                                path: [],
                                strokeColor: '#FF0000',
                                strokeWeight: 3
                            });
                            if (status == google.maps.DirectionsStatus.OK) {
                                var bounds = new google.maps.LatLngBounds();
                                var legs = response.routes[0].legs;
                                for (var i = 0; i < legs.length; i++) {
                                    var steps = legs[i].steps;
                                    for (var j = 0; j <steps.length;j++) {
                                        var nextSegment = steps[j].path;
                                        for (var k = 0; k < nextSegment.length; k++) {
                                            var coordinates = new google.maps.LatLng(nextSegment[k].lat(), nextSegment[k].lng());
                                            route.polyline.getPath().push(coordinates);
                                            bounds.extend(nextSegment[k]);
                                        }
                                    }
                                }
                            }
                            /*** Si la ruta esta cerca a mi ubicación ***/
                            if (google.maps.geometry.poly.isLocationOnEdge(ubicacionLatLng, route.polyline, 0.015)) {
                                verListaRutas(route, c);
                                c++;
                            }
                        });
                    });
                });
            }
        }
        function verListaRutas(route, index) {
            var element = document.getElementById("buscar_ride");
            
            if (route.destino.lat() == destinations.universidad[0] && route.destino.lng() == destinations.universidad[1]) {
                var destinonombre = "Ciudad Universitaria";
            }else if (route.destino.lat() == destinations.mederos[0] && route.destino.lng() == destinations.mederos[1]) {
                var destinonombre = "Mederos";
            }else if (route.destino.lat() == destinations.hospital[0] && route.destino.lng() == destinations.hospital[1]) {
                var destinonombre = "Hospital";
            }
            $("#buscar_ride").append("<div id='elem' class='elementos'>" +
                         "<a href='#' onclick='verRuta(" + route.id + ", " + index + ");' >" +
                         "<h1>" + route.nombre + "</h1>" +
                         "</a>" + 
                         "<p>" + route.anfitrion + "</p>" +
                         "<p>" + route.ubicacion + "</p>" + 
                         "<p>" + destinonombre + "</p>" +
                         "<p>" + route.horario + "</p>" +
                         "<p>" + route.dias + "</p>" +
                         "</div>");
        }
        function verRuta(id, index) {
            var contenedor = document.getElementsByClassName("elementos");
            var titulo = contenedor[index].getElementsByTagName("h1");
            var p = contenedor[index].getElementsByTagName("p");
            var ubicacion = p[1].innerHTML;
            var destino = p[2].innerHTML;
            var x = 0;
            var y = 0;
            
            if(destino == "Ciudad universitaria"){
                x = destinations.universidad[0];
                y = destinations.universidad[1];
            }else if(destino == "Mederos"){
                x = destinations.mederos[0];
                y = destinations.mederos[1];
            }else if(destino == "Hospital"){
                x = destinations.hospital[0];
                y = destinations.hospital[1];
            }
            
            $.getJSON('pedirRuta.php?id='+id, function(data) {
                var dataRoute = data[0];
                var route = {
                    id: dataRoute.id_ruta,
                    nombre: dataRoute.nom_ruta,
                    ubicacion: dataRoute.ubicacion,
                    origen: new google.maps.LatLng(dataRoute.origen_x, dataRoute.origen_y),
                    destino: new google.maps.LatLng(dataRoute.destino_x, dataRoute.destino_y),
                    horario: dataRoute.horario,
                    dias: dataRoute.dias
                };

                var location = {
                    lat:route.origen.lat(), 
                    lng: route.origen.lng()
                };
                var map = crearMapa(location, 2);

                var options = { 
                    position: miUbicacion,
                    title: "Tu ubicación"
                }
                var marker = new google.maps.Marker(options);
                marker.setMap(map);

                var directionsDisplay = new google.maps.DirectionsRenderer({
                    map: map,
                    polylineOptions: {
                        strokeColor: "red"
                    }
                });
                
                var request = {
                    origin: route.origen,
                    destination: route.destino,
                    travelMode: google.maps.TravelMode.DRIVING
                };
                
                var directionsService = new google.maps.DirectionsService();
                directionsService.route(request, function(response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                    }
                });
            });
            document.getElementById("buscar_ride").style.display = "none";
            document.getElementById("desc_ruta").style.display = "block";
            /*PASAR INFO AL DIV */
            document.getElementById("titulo").innerHTML = titulo[0].innerHTML;
            document.getElementById("usuario").innerHTML = "Anfitrion: "+p[0].innerHTML;
            document.getElementById("Origen").innerHTML = "Origen: " + ubicacion;
            document.getElementById("Destino").innerHTML = "Destino: "+ destino;
            document.getElementById("horarioDes").innerHTML = "Hora de salida: "+p[3].innerHTML;
            document.getElementById("diasDes").innerHTML = p[4].innerHTML;
        }
        function back(){
            document.getElementById("buscar_ride").style.display = "block";
            document.getElementById("desc_ruta").style.display = "none";
        }
        function limpiarListaRutas(){
            var elements = document.getElementsByClassName("elementos");
            while(elements.length > 0){
                elements[0].parentNode.removeChild(elements[0]);
            }
        }
        function solicitarRuta(){
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
    <div id="contenedor">
        <!-- MENU -->
        <?php include 'snippets/menu.html';?>
        <div id="sidebar">
			<div id="buscar_ride">
                <div id="buscador">
                    <form>
                        Destino:<br>
                        <select id="cbxDestino" name="destino">
                            <option value="Seleccionar">Seleccionar</option>
                            <option value="Ciudad universitaria">Ciudad universitaria</option>
                            <option value="Mederos">Mederos</option>
                            <option value="Hospital">Hospital</option>
                        </select>
                        <a href="#" onclick="buscarRutasCercanas();">Ver rutas</a>
                    </form> 
                </div>
			</div>
            <div id="desc_ruta">	
				<h1 id="titulo"></h1>
				<p id="usuario"></p>
				<p id="Origen"></p>
				<p id="Destino"></p>
				<h2>Dias y Horarios</h2>
				<p id="diasDes"></p>
				<p id="horarioDes"></p>
				<ul>
					<li><a href="#" onclick="back();">Volver</a></li>
					<li><a id="btn_solicitar" onclick="solicitarRuta();" href="#">Solicitar</a></li>
				</ul>
			</div>
		</div>
		<div id="mapa">
		</div>
        <div id="ventana">
			<div id="cont_ventana">
				<a href="#" onclick="cerrarSolicitud();" style="float:right">Cerrar</a>
				<h1>Solicitud de ride</h1>
				<h2>Nombre del ride</h2>
				<p>Parrafo de la ventana</p>
				<textarea rows="5" cols="50">
				</textarea>
				<input type="submit" value="Enviar solicitud">
			</div>
		</div>
	</div>
</body>
</html>