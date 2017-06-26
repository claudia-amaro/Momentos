<!--Campo de pesquisa-->
<!---->
<!--<nav>-->
<!--    <div class="nav-wrapper white">-->
<!--        <form>-->
<!--            <div class="input-field">-->
<!--                <input class="grey-text text-darken-3" id="search" type="search" required value="Inserir o id ou o local" onfocus="apagarvalue()" onblur="reporvalue()">-->
<!--                <label class="label-icon" for="search"><i class="material-icons grey-text text-darken-3" style="opacity: 2">search</i></label>-->
<!--            </div>-->
<!--        </form>-->
<!--    </div>-->
<!--</nav>-->
<!---->
<!--<script>-->
<!--    function apagarvalue() {-->
<!---->
<!--        document.getElementById('search').value = "";-->
<!---->
<!--    }-->
<!--    function reporvalue() {-->
<!---->
<!--        document.getElementById('search').value = "Inserir o id ou o local";-->
<!---->
<!--    }-->
<!--</script>-->

<?php

// Criação das listas para os valores da latitude e longitude
$latitude = array();
$longitude = array();

include_once('../connections/connection.php');

// Extrair dados da BD
$query = "SELECT latitude, longitude FROM momentos WHERE latitude IS NOT NULL ";
$result = mysqli_query($link, $query);

// Mostrar dados
while ($row_result = mysqli_fetch_assoc($result)){
    array_push($latitude,$row_result["latitude"]);
    array_push($longitude,$row_result["longitude"]);
};

//var_dump($latitude);
//var_dump($longitude);

// Fechar ligação à BD
mysqli_close($link);

?>

<script>

    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 40.000, lng: -7.000},
            zoom: 6
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

                //Marcador da localização atual
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

        // MOMENTOS

        var latitude = <?php echo json_encode($latitude)?>;
        console.log(latitude);

        var longitude = <?php echo json_encode($longitude)?>;
        console.log(longitude);


        n_max = latitude.length;
        console.log(n_max);

        for(n=0; n<n_max; n++){

            a = parseFloat(latitude[n]);
            b = parseFloat(longitude[n]);

            //Localização dos momentos
            var pos_1 = {
                lat: a,
                lng: b
            };

            //Marcadores dos momentos


// Texto padrão da documentação (infoWindow)
//                var contentString = '<div id="content">'+
//                    '<div id="siteNotice">'+
//                    '</div>'+
//                    '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
//                    '<div id="bodyContent">'+
//                    '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
//                    'sandstone rock formation in the southern part of the '+
//                    'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
//                    'south west of the nearest large town, Alice Springs; 450&#160;km '+
//                    '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major '+
//                    'features of the Uluru - Kata Tjuta National Park. Uluru is '+
//                    'sacred to the Pitjantjatjara and Yankunytjatjara, the '+
//                    'Aboriginal people of the area. It has many springs, waterholes, '+
//                    'rock caves and ancient paintings. Uluru is listed as a World '+
//                    'Heritage Site.</p>'+
//                    '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
//                    'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
//                    '(last visited June 22, 2009).</p>'+
//                    '</div>'+
//                    '</div>';

//                    var contentString = '<div id="content">'+
//                        '<div id="siteNotice">'+
//                        '</div>'+
//                        '<div id="bodyContent">'+
//                        '<p><b>Nascimento da Laurinha</b>'+
//                        '<p><a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
//                        'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
//                        '</div>'+
//                        '</div>';

//                    var infowindow = new google.maps.InfoWindow({
//                        content: contentString
//                    });

            var marc_1 = new google.maps.Marker({
                position: pos_1,
                map: map
            });

//                    marc_1.addListener('click', function() {
//                        infowindow.open(map, marc_1);
//                    });
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