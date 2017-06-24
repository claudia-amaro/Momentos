<form id="formulario" method="POST" action="moments_search_3.php">
    <input id="latitude" name="latitude" type="text">
    <input id="longitude" type="text">
    <input type="submit" name="longitude" value="Guardar">
</form>

<button onclick="initMap(); apagar_formulario();">Limpar</button>

<div id="map"></div>

<script>

    function deleteMarkers() {
        clearMarkers();
        markers = [];
    }

    var pontos_mapa = [];
    var latitude_momento;
    var longitude_momento;
    var listener;

    function formulario(){
        document.getElementById("latitude").value = latitude_momento;
        document.getElementById("longitude").value = longitude_momento;
        listener.remove();
    }

    function apagar_formulario(){
        document.getElementById("latitude").value = "";
        document.getElementById("longitude").value = "";
    }

    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 30.500, lng: -15.500},
            zoom: 6
        });

        // Adicionar novos pontos ao mapa, através de cliques no mapa
        listener = google.maps.event.addDomListener(map, 'dblclick', function addMyMarker(e) { //function that will add markers on button click
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(e.latLng.lat(), e.latLng.lng()),
                map: map,
                draggable: false,
                animation: google.maps.Animation.DROP,
                icon: "http://maps.google.com/mapfiles/ms/micons/green.png"
            });
            latitude_momento = e.latLng.lat();
            longitude_momento = e.latLng.lng();
            formulario();
        });

        var infoWindow = new google.maps.InfoWindow({map: map});

        // GEOLOCALIZAÇÃO - Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Estás aqui.');
                map.setCenter(pos);

                //marcador da localização atual
                var marc_pos_atual = new google.maps.Marker({
                    position: pos,
                    map: map
                });
                }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
    }

</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1ARZogHRRXz59P0qF89OXDH99wWtPZws&callback=initMap">
</script>