<?php
    include_once "gmaps_helper.php";
?>
<html>
    <head>
        <title>Επιλογή τοποθεσίας καταστήματος</title>
        <link rel='stylesheet' type='text/css' href='../../css/gmaps.css' />
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
    <script type="text/javascript">
       var geocoder = new google.maps.Geocoder();

        function geocodePosition(pos) {
            geocoder.geocode({
                latLng: pos
            }, function(responses) {
                    if (responses && responses.length > 0) {
                        updateMarkerAddress(responses[0].formatted_address);
                    } else {
                        updateMarkerAddress('Δε βρίσκεται κάποια γνωστή διεύθυνση κοντά στο σημείο');
                    }
                });
        }

        function updateMarkerStatus(str) {
            document.getElementById('markerStatus').innerHTML = str;
        }
        
        
        function updateMarkerPosition(latLng) {
            document.getElementById('info_lat').value = [
                latLng.lat()
            ].join('');
            document.getElementById('info_lng').value = [
                latLng.lng()
            ].join(''); 
        }        


        function updateMarkerAddress(str) {
            
            var re1 = /,.*[0-9]/;
            var match = re1.exec(str);
            var re2 = /[^,][^0-9]*/;
            var match2 = re2.exec(match);
            var re3 = /[^ ].*[^ ]/;
            var match3 = re3.exec(match2);
            
            var re4 = /,.*[0-9]/;
            var match4 = re4.exec(str);
            var re5 = /[0-9][0-9]* [0-9]*/;
            var match5 = re5.exec(match4);
            
            document.getElementById('address_info').innerHTML = str;
            document.getElementById('address').value = str.match(/[^,]*/);
            document.getElementById('city').value = match3;
            document.getElementById('postal_code').value = match5;
            
        }

        function initialize() {
            var latLng = new google.maps.LatLng(39.164341, 23.833157);
            var map = new google.maps.Map(document.getElementById('mapCanvas'), {
                zoom: 7,
                center: latLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var marker = new google.maps.Marker({
                position: map.getCenter(),
                title: '',
                map: map,
                draggable: true
            });
  
            updateMarkerPosition(latLng);
            geocodePosition(latLng);


            google.maps.event.addListener(marker, 'rightclick', function() {
                map.setZoom(15);
                map.setCenter(marker.getPosition());
            });

            google.maps.event.addListener(marker, 'dragstart', function() {
                updateMarkerAddress();
            });

            google.maps.event.addListener(marker, 'drag', function() {
                updateMarkerStatus();
                updateMarkerPosition(marker.getPosition());
            });

            google.maps.event.addListener(marker, 'dragend', function() {
                updateMarkerStatus();
                geocodePosition(marker.getPosition());
            });

        }

        google.maps.event.addDomListener(window, 'load', initialize);

        </script>
        </head>
        
        <body>
            <div id="mapCanvas"></div>
            <div id="markerStatus" hidden></div>
            <form name="reg_form" method="post" action="">
                <div class="bold">Σύρετε τον δείκτη στο σημείο που βρίσκεται το κατάστημα σας κι έπειτα πατήστε το κουμπί "Κλείσιμο χάρτη".
                    <br />
                    Κάντε δεξί κλικ στον δείκτη για να ζουμάρετε στο συγκεκριμένο σημείο.
                </div>
                    <br />
                    <br />
                <input type="text" id="info_lat" name="latitude" hidden />
                <input type="text" id="info_lng" name="longitude" hidden />
                <div class="bold">Κοντινότερη διεύθυνση:</div>
                <div id="address_info"></div>
                <input type="text" id="city" name="city" hidden />
                <input type="text" id="address" name="address" hidden />
                <input type="text" id="postal_code" name="postal_code" hidden />
                    <br />
                <div id="center"><input name="Close" type="submit" id="Close" onClick="Javascript:updateOpener()" value="Κλείσιμο χάρτη"></div>
            </form>
        </body>
</html>

