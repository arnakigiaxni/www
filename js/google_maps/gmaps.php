<?php
    include_once "gmaps_helper.php";
?>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
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
  document.getElementById('address').innerHTML = str;
}

function initialize() {
  var latLng = new google.maps.LatLng(39.164341, 23.833157);
  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom: 7,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var marker = new google.maps.Marker({
    position: latLng,
    title: 'Point A',
    map: map,
    draggable: true
  });
  
  // Update current position info.
  updateMarkerPosition(latLng);
  geocodePosition(latLng);
  
  // Add dragging event listeners.
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

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);

function closeSelf(){

}
</script>
</head>
<body>
  <style>
  #mapCanvas {
    width: 650px;
    height: 590px;
    float: left;
  }
  #infoPanel {    
    margin-left: 10px;
  }
  #infoPanel div {
    margin-bottom: 5px;
  }
  </style>
  
  <div id="mapCanvas"></div>
  <div id="infoPanel">
    <div id="markerStatus" hidden></div>
    <b>Current position:</b>
    <br />
    <input type="text" id="info_lat" name="lat" />
    <br />
    <input type="text" id="info_lng" name="lng" />
    <br />
    <b>Closest matching address:</b>
    <div id="address"></div>
    <input type="button" value="OK"  onclick="closeSelf();"/>
  </div>
</body>
</html>

