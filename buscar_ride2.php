<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
            html, body { height: 100%; margin: 0; padding: 0; }
            #map { height: 100%; }
        </style>
    </head>
    <body>
    <div id="map">
        <div id="0"></div>
    </div>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script>
        function initMap() {
            var location = new google.maps.LatLng(25.715084, -100.353784);
            var uanl = new google.maps.LatLng(25.7238862, -100.31285739999998);
            
            var map = new google.maps.Map(document.getElementById('map'), {
                center: location,
                zoom: 14
            });
            
            $.getJSON('rutasdata.php', function(data) {
                var routes = [];
                $.each(data, function(index, route) {
                    routes.push(
                        {
                            nombre: route.nom_ruta,
                            origen: new google.maps.LatLng(route.origen_x, route.origen_y),
                            destino: new google.maps.LatLng(route.destino_x, route.destino_y)
                        }
                    );
                });
                
                location = new google.maps.LatLng(25.715084, -100.353784);
                uanl = new google.maps.LatLng(25.7238862, -100.31285739999998);

                /*** Muestro la ruta de mi ubicación hacia la uni ***/
                var directionsService = new google.maps.DirectionsService();
                var request = {
                    origin: location,
                    destination: uanl,
                    travelMode: google.maps.TravelMode.DRIVING
                };
                directionsService.route(request, function(response, status) {
                    /*var directionsRenderer = new google.maps.DirectionsRenderer({
                        polylineOptions: { strokeColor: "blue"}
                    });*/
                    var directionsRenderer = new google.maps.DirectionsRenderer();
                    directionsRenderer.setMap(map);
                    directionsRenderer.setDirections(response);
                });
                
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
                        if (google.maps.geometry.poly.isLocationOnEdge(location, route.polyline, 10e-3)) {
                            var directionsRenderer = new google.maps.DirectionsRenderer({
                                polylineOptions: { strokeColor: "red"}
                            })
                            directionsRenderer.setMap(map);
                            directionsRenderer.setDirections(response);
                        }
                    });
                });
            });
        }
    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJywoknUVkMygQ_OvEzJWhmQq_SMFG4No&callback=initMap&region=MX&libraries=geometry,places">
    </script>
  </body>
</html>
