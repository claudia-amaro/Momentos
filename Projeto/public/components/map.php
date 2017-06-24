<div id="map">
    <input id="search" type="search" required>
    <label class="label-icon" for="search"><i class="material-icons">search</i></label>
    <i class="material-icons">close</i>
</div>
<script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 40.000, lng: -8.000},
            zoom: 7
        });

//        google.maps.event.addDomListener(map, 'click', function addMyMarker(e) { //function that will add markers on button click
//            var marker = new google.maps.Marker({
//                position: new google.maps.LatLng(e.latLng.lat(), e.latLng.lng()),
//                map: map,
//                draggable: true,
//                animation: google.maps.Animation.DROP,
//                title: "This a new tree!",
//                icon: "http://maps.google.com/mapfiles/ms/micons/blue.png"
//            })});

        var infoWindow = new google.maps.InfoWindow({map: map});
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Location found.');
                map.setCenter(pos);

                //marcador da localização
                var pos = new google.maps.Marker({
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