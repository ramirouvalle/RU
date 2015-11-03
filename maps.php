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
      var coor_x = 0;
      var coor_y = 0;

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

      function prevRuta(ubicacion){
        initMap();
        var valor
        if(ubicacion == ""){
          valor = document.getElementById("ubi").value;
        }else{
          valor = ubicacion;
        }
        if(valor != ""){
         document.getElementById("map").style.display = "block";
          initMap();
            var request = {
                origin: valor,
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
        }else{
            alert("Se necesita una ubicacion");
        }
      }
      //---------------------------------

      function muestraInfo(){
          document.getElementById("bienvenida").style.display = "none";
          document.getElementById("map").style.display = "block";
          document.getElementById("info").style.display = "block";
          initMap();
      }
      ///////////////////////////////////////////////////////////////////
      /* Cuando se busca las rutas */
      function muestraListaRutas(){
          var cont = document.getElementById("menu-sidebar");
          var b = cont.getElementsByTagName("li");
          b[0].style.backgroundColor = "#2ecc71";
          b[1].style.backgroundColor = "LightGreen";
          document.getElementById("pnl_buscar_rutas").style.display = "block";
          document.getElementById("pnl_crear_ruta").style.display = "none";
      }
      ///////////////////////////////
      /* Cuando se crea un ruta */
      function crearRuta(){
          var cont = document.getElementById("menu-sidebar");
          var b = cont.getElementsByTagName("li");
          b[0].style.backgroundColor = "LightGreen";
          b[1].style.backgroundColor = "#2ecc71";
          document.getElementById("pnl_crear_ruta").style.display = "block";
          document.getElementById("pnl_buscar_rutas").style.display = "none";
      }
      ////////////////////////////
      /* Pasar informacion de la ruta al div info */
      function pasarInfo(cont){
          var contenedor = document.getElementsByClassName("elementos");
          var titulo = contenedor[cont].getElementsByTagName("h1");
          var p = contenedor[cont].getElementsByTagName("p");
          var ubicacion = p[1].innerHTML;
          prevRuta(ubicacion);
          document.getElementById("info_titulo").innerHTML = titulo[0].innerHTML;
          document.getElementById("info_user").innerHTML = p[0].innerHTML;
          document.getElementById("creacion").style.display = "none";

      }
      function mostrarCrear(){
          document.getElementById("creacion").style.display = "block";
          document.getElementById("map").style.display = "block";
          document.getElementById("bienvenida").style.display = "none";
          document.getElementById("info").style.display = "none";
      }
    </script>
  
  </head>
  <body>
    <header>
      <div id="logo">
            <p>RideUniversitario</p>
        </div>
      <div id="ops_user">
          <?php 
              @session_start();
              echo @$_SESSION['usuario'];
          ?>
          <a href="logout.php">Cerrar sesión</a>
      </div>
    </header>
    <section>
        <div id="sidebar">
            <div id="menu-sidebar">
                  <ul>
                      <li><a href="#" onclick="crearRuta();  mostrarCrear();">Dar Ride</a></li>
                      <li><a href="#" onclick="muestraListaRutas();" >Buscar Ride</a></li>
                  </ul>
            </div>
            <div id="pnl_crear_ruta">
              <!--
                <form>
                    <p>Origen</p>
                    <input type="text" id="inicio" placeholder="Origen" />
                    <input type="button" id="buscar" onclick="ruta();" value="Buscar" />
                </form>
              -->
                <div id="panelRuta">
                </div>
            </div>
            <div id="pnl_buscar_rutas">
                    <?php
                        require("verRutas.php");
                    ?>
            </div>       
        </div>
        <div id="contenido">
          
            <div id="bienvenida">
              <h1>Bienvenidos a la pagina</h1>
            </div>
            <div id="map">
            </div>
            <div id="info">
                <div id="titular">
                    <h2 id="info_titulo">Ride desde guadalupe</h2>
                    <h3 id="info_user">ramUva</h3>
                </div>
                <div id="extras">
                    <h2>Descripción</h2>
                    <div id="descripcion" class="tip_info">
                        <p></p>
                   </div>
                   <h2>Horarios</h2>
                   <div id="horarios" class="tip_info">
                   </div>
                   <div id="opciones">
                      <input type="submit" value="Solicitar ride">
                   </div>
                </div>
              </div>
            
              <div id="creacion">
                  <h1>Crear nueva ruta</h1>
                  <form method="POST" action="guardar_ruta.php">
                      <input type="text" id="ubi" name="ubicacion" placeholder="Ubicacion">
                      <a href="#" onclick="var v = document.getElementById('ubi').value; prevRuta(v);">Visualizar Ruta</a>
                      <input type="text" name="titulo" placeholder="Nombre de la ruta">
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
                      <input type="submit" name="btnCrearRuta" value="Guardar RUTA">    
                  </form>
              </div>
        </div>
    </section>

  </body>
</html>