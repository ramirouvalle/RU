<?include ("seguridad.php");?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?ey=AIzaSyAVTXAAvDwe8OaeC3xg2KVqgKYWhn7zv_E&callback=initMap">
    </script>
    <script type="text/javascript">
      var directionsDisplay;
      var directionsService = new google.maps.DirectionsService();
      var map;

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
          map = new google.maps.Map(document.getElementById('map'), mapConfig);
          directionsDisplay = new google.maps.DirectionsRenderer();
          directionsService = new google.maps.DirectionsService();
      }

      function ruta(){
          var request = {
              origin: document.getElementById("inicio").value,
              //destination: document.getElementById("fin").value,
              destination: new google.maps.LatLng(25.7238862, -100.31285739999998),
              travelMode: google.maps.TravelMode.DRIVING,
              unitSystem: google.maps.UnitSystem.METRIC,
              provideRouteAlternatives: true
          };
          directionsService.route(request, function(response, status) {
              if (status == google.maps.DirectionsStatus.OK) {
                  directionsDisplay.setMap(map);
                  directionsDisplay.setPanel($("#panel_ruta").get(0));
                  directionsDisplay.setDirections(response);
              } else {
                  alert("No existen rutas entre ambos puntos");
              }
              if (status == google.maps.DirectionsStatus.OK) {
                  directionsDisplay.setMap(map);
                  directionsDisplay.setPanel(document.getElementById("panelRuta"));
                  directionsDisplay.setDirections(response);
              }else{
                  alert("No exiten");
              }
          });
      }

      $('#buscar').live('click', function(){
          ruta();
      });
      //---------------------------------
      function muestraInfo(){
          document.getElementById("bienvenida").style.display = "none";
          document.getElementById("map").style.display = "block";
          document.getElementById("info").style.display = "block";
          initMap();
      }
      ///////////////////////////////////////////////////////////////////
      function muestraListaRutas(){
          document.getElementById("pnl_buscar_rutas").style.display = "block";
          document.getElementById("pnl_crear_ruta").style.display = "none";
      }
      function crearRuta(){
          document.getElementById("pnl_crear_ruta").style.display = "block";
          document.getElementById("pnl_buscar_rutas").style.display = "none";
      }
    </script>
  
  </head>
  <body>
    <header>
      <div id="logo">
            <p>RideUniversitario</p>
        </div>
      <div id="ops_user">
          <a href="logout.php">Cerrar sesión</a>
      </div>
    </header>
    <section>
        <div id="sidebar">
            <div id="menu-sidebar">
                  <ul>
                      <li><a href="#" onclick="crearRuta();">Dar Ride</a></li>
                      <li><a href="#" id="busca_ride" onclick="muestraListaRutas();" >Buscar Ride</a></li>
                  </ul>
            </div>
            <div id="pnl_crear_ruta">
                <form>
                    <p>Origen</p>
                    <input type="text" id="inicio" placeholder="Origen" />
                    <input type="button" id="buscar" onclick="ruta();" value="Buscar" />
                    <input type="button" id="ruta" onclick="muestraInfo();" value="Ruta"/>
                </form>
            </div>
            <div id="pnl_buscar_rutas">
                    <?php
                        require("verRutas.php");
                    ?>
            </div>
              <!-- 
              Donde se muestra las indicaciones de la ruta (No es necesario)
              <div id="panelRuta">
              </div>
              -->        
        </div>
        <div id="contenido">
            <div id="bienvenida">
              <h1>Bienvenidos a la pagina</h1>
            </div>
            <div id="map">
            </div>
            <div id="info">
                <div id="titular">
                    <h2>Ride desde guadalupe</h2>
                    <h3>ramUva</h3>
                </div>
                <div id="extras">
                    <h2>Descripción</h2>
                    <div id="descripcion">
                        <p>Esta sera la descripcion sobre el ride donde se podra agregar: 
                        <br>Horarios
                        <br>Los dias que se realiza
                        <br>Para cuantas personas esta disponible, etc.
                      </p>
                   </div>
                   <div id="opciones">
                      <input type="submit" value="Solicitar ride">
                   </div>
                </div>
              </div>
        </div>
    </section>

  </body>
</html>