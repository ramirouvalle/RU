<?php include 'seguridad.php';?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript">
		cargarMisRutas();
		function cargarMisRutas(){
			$.getJSON("obtener_misRides.php",function(data){
				var routes = [];
                $.each(data, function(index, route) {
                    routes.push(
                    {
                        id: route.id_ruta,
                        anfitrion: route.anfitrion,
                        nombre: route.nom_ruta,
                        ubicacion: route.ubicacion,
                        origen: {
                        	lat: route.origen_x,  
                        	lng: route.origen_y
                        },
                        destino: {
                        	lat: route.destino_x, 
                        	lng: route.destino_y
                        },
                        horario: route.horario,
                        dias: route.dias
                    }
                    );
                });
                routes.forEach(function(route, index) {
                	var contenedor = document.getElementById("central");
                	//Creamos el contenedor para la descripcion del ride
                	var div = document.createElement("div");
                	div.setAttribute("class", "miRide box");

                	var div_desc = document.createElement("div");
                	div_desc.setAttribute("class", "miRideDesc");
                	//Creamos el titulo 
                	var nombre_ride = document.createElement("h1");
                	nombre_ride.appendChild(document.createTextNode(route.nombre));
					
					//Creamos el elemento y texto para el anfitrion
					var anfitrion = document.createElement("p");
					anfitrion.appendChild(document.createTextNode(route.anfitrion));

					//Creamos el elemento y texto para el origen
					var origen = document.createElement("p");
					origen.appendChild(document.createTextNode("Punto de partida: " + route.ubicacion));

					//Creamos el elemento y texto para el destino
					var destino = document.createElement("p");
					var text_destino;
					if(route.destino.lat == 25.7238862 && route.destino.lng == -100.31285739999998){
						text_destino = "Ciudad Universitaria";
					}else if(route.destino.lat == 25.61415077 && route.destino.lng  == -100.28184055999998){
						text_destino = "Mederos";
					}else if(route.destino.lat == 25.69185015 && route.destino.lng  == -100.34884213999999){
						text_destino = "Hospital";
					}
					destino.appendChild(document.createTextNode("Destino: " +text_destino));

					//Creamos el elemento y texto para los dias
					var dias = document.createElement("p");
					dias.appendChild(document.createTextNode("Dias: "+route.dias));

					//Creamos el elemento y texto para la hora
					var hora = document.createElement("p");
					hora.appendChild(document.createTextNode("Hora: " + route.horario));

					var div_links =  document.createElement("div");
					div_links.setAttribute("class","miRideLinks");
					//Creamos los botones de editar y eliminar
					var btn_editar = document.createElement("a");
					btn_editar.setAttribute("class", "btn_yellow");
					btn_editar.setAttribute("href", "#");
					btn_editar.appendChild(document.createTextNode("Editar"));

					var btn_eliminar = document.createElement("a");
					btn_eliminar.setAttribute("class", "btn_yellow");
					btn_eliminar.setAttribute("href", "#");
					btn_eliminar.appendChild(document.createTextNode("Eliminar"));

					div_links.appendChild(btn_editar);
					div_links.appendChild(btn_eliminar);
					//Agregamos los elementos al div
					div_desc.appendChild(nombre_ride);
					div_desc.appendChild(origen);
					div_desc.appendChild(destino);
					div_desc.appendChild(dias);
					div_desc.appendChild(hora);

					div.appendChild(div_desc);
					div.appendChild(div_links);
					//Agregamos el div al contenedor
                	contenedor.appendChild(div);
                	contenedor.setAttribute("style","overflow-y:auto");
                });
			});
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
		</div>
</body>
</html>