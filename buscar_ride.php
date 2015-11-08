<html>
<head>
	<title>Buscar ride</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css">
	<script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVTXAAvDwe8OaeC3xg2KVqgKYWhn7zv_E&callback=initMap">
    </script>
    <script>
    	var directionsDisplay;
	    var directionsService = new google.maps.DirectionsService();
	    var map;
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
    	}
    </script>
</head>
<body>
	<header>
		<div id="logo">
			<p>RideUniversitario</p>
		</div>
		<div id="ops_users">
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
		</div>
		<div id="mapa">
		</div>
	</div>
</body>
</html>