<html>
<meta charset="UTF-8">
<head>
	<title>RideUniversitario</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="css/styles.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVTXAAvDwe8OaeC3xg2KVqgKYWhn7zv_E&callback=initMap">
    </script>
    <script>
      var directionsDisplay;
      var directionsService = new google.maps.DirectionsService();
      var map;
      var lat; 
      var lng;
      var infowindow = new google.maps.InfoWindow();
	  var marker;
	  
      function initMap() {
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
    	function miUbicacion(){
			geocoder = new google.maps.Geocoder();
			var latlng = new google.maps.LatLng(lat, lng);
			geocoder.geocode({'latLng': latlng}, function(results, status) {
			    if (status == google.maps.GeocoderStatus.OK) {
			        if (results[0]) {
			        	document.getElementById("ubi").value = results[0].formatted_address;
			        } else {
			        	alert('No hay resultados');
			        }
			    } else {
			        alert('Geocoder failed due to: ' + status);
			    }
		    });
		}

    	
    	function prevRuta(ubicacion){
    		var valor;
	        if(ubicacion == ""){
	        	valor = document.getElementById("ubi").value;
	        }else{
	        	valor = ubicacion;
	        }
	        var seleccionado = document.getElementById("cbxDestino").selectedIndex;
	        //alert(seleccionado);
	        if(valor != ""){
	        	var destLAT = 0;
	            var destLNG = 0;
		        if(seleccionado == 0){
		          	destLAT = 25.7238862;
		          	destLNG = -100.31285739;
		        }else if(seleccionado == 1){
		          	destLAT = 25.61415077;
		          	destLNG = -100.28184056;
		        }else if(seleccionado == 2){
		          	destLAT = 25.69185015;
		          	destLNG = -100.34884214;
		        }
		        var request = {
		            origin: valor,
		            destination: new google.maps.LatLng(destLAT, destLNG),
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
	        }else{
	            alert("Se necesita una ubicacion");
	        }
    	}
    	/* PASAR DIRECCION A COORDENADAS */
    	/*
    	function dirACoords(){
    		var geocoder = new google.maps.Geocoder();
    		var dir = document.getElementById("ubi").value;
    		geocoder.geocode({ 'address': dir}, function(results, status){
    			if (status == 'OK') {
    				var pos = results[0].geometry.location;
    				alert(pos);
        		}
    		});
    	}*/

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
					<li><a href="#">Dar Ride</a></li>
					<li><a href="buscar_ride.php" >Buscar ride</a></li>
				</ul>
			</div>
			<div id="dar_ride">
				<h1>Crear nueva ruta</h1>
				<form method="POST" action="guardar_ruta.php">
					  Origen:
					  <a href="#" onclick="miUbicacion();" style="float: right">Mi ubicacion</a>
                      <input type="text" id="ubi" name="ubicacion" placeholder="Ubicacion">
                      Destino:
					  <select id="cbxDestino" name="destino">
					  	<option>Ciudad universitaria</option>
					  	<option>Mederos</option>
					  	<option>Hospital</option>
					  </select>
					  <a href="#" onclick="var v = document.getElementById('ubi').value; prevRuta(v); dirACoords();">Visualizar Ruta</a>
                      <input type="text" name="titulo" placeholder="Nombre de la ruta">
                      <input type="text" name="descripcion" placeholder="Descripcion">
                      <input type="text" name="horario" placeholder="Horario de salida">
                      <h2>Dias que realiza la ruta</h2>
                      <table>
                          <tr>
                              <td><input type="checkbox" name="dias[]" value="Lunes">Lunes <br></td>
                              <td><input type="checkbox" name="dias[]" value="Martes">Martes <br></td>
                              <td><input type="checkbox" name="dias[]" value="Miercoles">Miercoles <br></td>
                              <td><input type="checkbox" name="dias[]" value="Jueves">Jueves <br></td>
                          </tr>
                          <tr>
                              <td><input type="checkbox" name="dias[]" value="Viernes">Viernes <br></td>
                              <td><input type="checkbox" name="dias[]" value="Sabado">Sabado <br></td>
                              <td><input type="checkbox" name="dias[]" value="Domingo">Domingo</td>
                          </tr>
                      </table>
                      <input type="submit" name="btnCrearRuta" value="Guardar">    
                  </form>
			</div>
			<div id="buscar_ride">
			</div>
		</div>
		<div id="mapa">
		</div>
	</div>
</body>
</html>