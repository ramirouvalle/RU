<?include ("seguridad.php");?>
<html>
<meta charset="UTF-8">
<head>
	<title>Buscar ride</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="css/styles.css" rel="stylesheet" type="text/css">
	<script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVTXAAvDwe8OaeC3xg2KVqgKYWhn7zv_E&callback=initMap">
    </script>
    <script>
    	var directionsDisplay;
	    var directionsService = new google.maps.DirectionsService();
	    var map;
	    var lat; 
        var lng;
    	function initMap(){
    		directionsDisplay = new google.maps.DirectionsRenderer();
          	//COORDENADAS DE LA UNIVERSIDAD
          	var uanl = new google.maps.LatLng(25.7238862, -100.31285739999998);
          	//CONFIGURACION DEL MAPA
            var mapConfig = {
            	zoom: 13,
                center: uanl
          	}
          	//MAPA
            map = new google.maps.Map(document.getElementById('mapa'), mapConfig);
            directionsDisplay = new google.maps.DirectionsRenderer();
            directionsService = new google.maps.DirectionsService();

            if (navigator.geolocation) {
		    navigator.geolocation.getCurrentPosition(function(position) {
			    lat = position.coords.latitude;
    			lng = position.coords.longitude;
    			var coords = new google.maps.LatLng(lat, lng);
			    var options = { position: new google.maps.LatLng(lat, lng) }
			    var marker = new google.maps.Marker(options);
    			marker.setMap(map);
			    map.setCenter(coords);
			    map.setZoom(15);
		    }, function() {
		      	handleLocationError(true, infoWindow, map.getCenter());
		    });
		  } else {
		    // Browser doesn't support Geolocation
		    handleLocationError(false, infoWindow, map.getCenter());
		  }
    	}

    	function verRuta(cont){
    		var contenedor = document.getElementsByClassName("elementos");
            var titulo = contenedor[cont].getElementsByTagName("h1");
            var p = contenedor[cont].getElementsByTagName("p");
            var ubicacion = p[0].innerHTML;
            var destino = p[1].innerHTML;
            var x = 0;
            var y = 0;
            if(destino == "Ciudad universitaria"){
            	x = 25.7238862;
            	y = -100.31285739999998;
            }else if(destino == "Mederos"){
            	x = 25.61415077;
            	y = -100.28184056;
            }else if(destino == "Hospital"){
            	x = 25.69185015;
            	y = -100.34884214;
            }

            /* DIBUJAR RUTA */
            var request = {
		        origin: ubicacion,
		        destination: new google.maps.LatLng(x, y),
		        travelMode: google.maps.TravelMode.DRIVING,
		        unitSystem: google.maps.UnitSystem.METRIC,
		        provideRouteAlternatives: true
		    };
		    directionsService.route(request, function(response, status) {
		        if (status == google.maps.DirectionsStatus.OK) {
		            directionsDisplay.setMap(map);
		            //directionsDisplay.setPanel($("#panel_ruta").get(0));
		            directionsDisplay.setDirections(response);
		        } else {
		            alert("No existen rutas entre ambos puntos");
		        }
		    });
		    document.getElementById("buscar_ride").style.display = "none";
		    document.getElementById("desc_ruta").style.display = "block";
		    /*PASAR INFO AL DIV */
		    document.getElementById("titulo").innerHTML = titulo[0].innerHTML;
		    document.getElementById("Origen").innerHTML = "Origen: " + ubicacion;
		    document.getElementById("Destino").innerHTML = "Destino: "+ destino;
    		document.getElementById("horarioDes").innerHTML = p[2].innerHTML;
    		document.getElementById("diasDes").innerHTML = p[3].innerHTML;
    	}
    	function back(){
    		document.getElementById("buscar_ride").style.display = "block";
    		document.getElementById("desc_ruta").style.display = "none";
    	}

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
				<?php
					include("verRutas.php");
				?>
			</div>
			<div id="desc_ruta">	
				<a href="#" onclick="back();">Volver</a>			
				<h1 id="titulo"></h1>
				<p id="usuario"></p>
				<p id="Origen"></p>
				<p id="Destino"></p>
				<h2>Dias y Horarios</h2>
				<p id="diasDes"></p>
				<p id="horarioDes"></p>
				
			</div>
		</div>
		<div id="mapa">
		</div>
	</div>
</body>
</html>