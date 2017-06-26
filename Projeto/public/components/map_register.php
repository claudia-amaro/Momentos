<style>

    .controls {
        margin-top: 55px !important;
        border: 1px solid transparent !important;
        border-radius: 2px 0 0 2px !important;
        box-sizing: border-box !important;
        -moz-box-sizing: border-box !important;
        height: 32px !important !important;
        outline: none !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3) !important;
    }

    #pac-input {
        background-color: #fff !important;
        font-family: Roboto !important;
        font-size: 15px !important;
        font-weight: 300 !important;
        margin-left: 10px !important;
        padding: 0 11px 0 13px !important;
        text-overflow: ellipsis !important;
        width: 80% !important;
        left: 0px !important;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    .pac-container {
        font-family: Roboto;
    }

    #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
    }

    #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }
</style>

<form id="formulario" method="POST" action="../components/map_register_control.php">
    <input id="latitude" name="latitude" type="hidden">
    <input id="longitude" name="longitude" type="hidden">
    <input style="width: 46.5%; margin-left: 2%" class="waves-effect waves-dark btn blue offset-s2" type="submit" value="Guardar"><button style="width: 46.5%; margin-right: 2%" type="button" class="waves-effect btn blue right" onclick="initMap(); apagar_formulario();">Limpar</button>
</form>

<input id="pac-input" class="controls" type="text" placeholder="Inserir localização">

<div style="display: none" id="type-selector" class="controls">
    <input type="radio" name="type" id="changetype-all" checked="checked">
    <label for="changetype-all">All</label>

    <input type="radio" name="type" id="changetype-establishment">
    <label for="changetype-establishment">Establishments</label>

    <input type="radio" name="type" id="changetype-address">
    <label for="changetype-address">Addresses</label>

    <input type="radio" name="type" id="changetype-geocode">
    <label for="changetype-geocode">Geocodes</label>
</div>

<div id="map" style="z-index: 100"></div>

<script>

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
            center: {lat: 40.000, lng: -7.000},
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
                infoWindow.setContent('Está aqui.');
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

        // AUTOCOMPLETE

        var input = /** @type {!HTMLInputElement} */(
            document.getElementById('pac-input'));

        var types = document.getElementById('type-selector');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
//                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
            }
//            marker.setIcon(/** @type {google.maps.Icon} */({
//                url: place.icon,
//                size: new google.maps.Size(71, 71),
//                origin: new google.maps.Point(0, 0),
//                anchor: new google.maps.Point(17, 34),
//                scaledSize: new google.maps.Size(35, 35)
//            }));
//            marker.setPosition(place.geometry.location);
//            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

//            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
//            infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
            var radioButton = document.getElementById(id);
            radioButton.addEventListener('click', function() {
                autocomplete.setTypes(types);
            });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
    }

</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1ARZogHRRXz59P0qF89OXDH99wWtPZws&libraries=places&callback=initMap">
</script>