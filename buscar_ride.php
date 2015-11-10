<?include "seguridad.php";?>
<html>
<meta charset="UTF-8">
<head>
    <title>Buscar ride</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script>
        window.geoloc;
        window.googlemap;
        
        function geoLocation() {
            if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        
                        /*** Inicializo mi ubicación ***/
                        var lat = position.coords.latitude;
                        var lng = position.coords.longitude;
                        var location = new google.maps.LatLng(lat, lng);
                        //location = new google.maps.LatLng(25.713423, -100.352685);
                        window.geoloc = location;
                        var uanl = new google.maps.LatLng(25.726406, -100.3119038);
                        
                        var map = new google.maps.Map(document.getElementById('mapa'), {
                            center: {lat: lat, lng: lng},
                            scrollwheel: false,
                            zoom: 13
                        });
                        
                        window.googlemap = map;

                        var directionsDisplay = new google.maps.DirectionsRenderer({
                            map: map
                        });

                        // Set destination, origin and travel mode.
                        var request = {
                            destination: uanl,
                            origin: location,
                            travelMode: google.maps.TravelMode.DRIVING
                          };
                        
                        var directionsService = new google.maps.DirectionsService();
                        directionsService.route(request, function(response, status) {
                            if (status == google.maps.DirectionsStatus.OK) {
                              // Display the route on the map.
                              directionsDisplay.setDirections(response);
                            }
                        })
                        initMap(map, location, uanl)
                        
                    }, function() {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                    return;
            }
        }
        
        function initMap(map, location, uanl) {
            /*** Consigue las rutas que hay en la base de datos ***/
            $.getJSON('rutasdata.php', function(data) {
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
                        
                        var destinations = [
                            google.maps.LatLng(25.7238862, -100.31285739999998),
                            google.maps.LatLng(25.61415077, -100.28184056),
                            google.maps.LatLng(25.726406, -100.3119038)
                        ];
                        /*** Si la ruta esta cerca a mi ubicación ***/
                        if (google.maps.geometry.poly.isLocationOnEdge(location, route.polyline, 10e-3)
                            /*&& (destinations.indexOf(route.destino) > -1)*/) {
                            //console.log(index);
                            //console.log(route.nombre);
                            
                            verOpcion(route, index);
                        }
                    });
                });
            });
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
                x = 25.726406;
                y = -100.3119038;
            }else if(destino == "Mederos"){
            	x = 25.61415077;
            	y = -100.28184056;
            }else if(destino == "Hospital"){
            	x = 25.69185015;
            	y = -100.34884214;
            }
            
            console.log(index);
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
                
                var uanl = new google.maps.LatLng(25.726406, -100.3119038);
                
                var directionsDisplay = new google.maps.DirectionsRenderer({
                    map: window.googlemap,
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
        function mostrarventana(){
            document.getElementById("ventana").style.display = "block";
        }
        function verOpcion(route, index) {
            var element = document.getElementById("buscar_ride");
            
            var destinonombre = "Destino";
            if (route.destino.lat() == 25.7238862 && route.destino.lng() == -100.31285739999998) {
                destinonombre = "Ciudad Universitaria";
            }
            else if (route.destino.lat() == 25.61415077 && route.destino.lng() == -100.28184056) {
                destinonombre = "Mederos";
            }
            else if (route.destino.lat() == 25.69185015 && route.destino.lng() == -100.34884214) {
                destinonombre = "Hospital";
            }
            console.log(index);
            
            $("#buscar_ride").append("<div id='elem' class='elementos'>" +
                         "<a href='#' onclick='verRuta(" + route.id + ", " + index + ");' >" +
                         "<h1>" + route.nombre + "</h1>" +
                         "</a>" + "<p>" + route.anfitrion + "</p>" +
                         "<p>" + route.ubicacion +
                         "</p>" + "<p>" + destinonombre + "</p>" +
                         "<p>" + route.horario + "</p>" +
                         "<p>" + route.dias + "</p>" +
                         "</div>");
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJywoknUVkMygQ_OvEzJWhmQq_SMFG4No&callback=geoLocation&region=MX&libraries=geometry,places">
    </script>
</head>
<body>
	<header>
		<div id="logo">
			<p>RideUniversitario</p>
		</div>
		<div id="ops_users">
			<?php 
                @session_start();
        	    echo @$_SESSION['usuario'];
            ?>
          <a href="logout.php">Cerrar sesión</a>
		</div>
	</header>
	<div id="contenedor">
		<div id="sidebar">
			<div id="menu_sidebar">
				<ul>
					<li><a href="mapa.php">Dar Ride</a></li>
					<li><a href="#">Buscar ride</a></li>
				</ul>
			</div>
			<div id="buscar_ride">
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
					<li><a id="btn_solicitar" onclick="mostrarventana();" href="#">Solicitar</a></li>
				</ul>
			</div>
		</div>
		<div id="mapa">
		</div>
        <div id="ventana">
			<div id="cont_ventana">
				<a href="#" onclick="document.getElementById('ventana').style.display = 'none';" style="float:right">Cerrar</a>
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