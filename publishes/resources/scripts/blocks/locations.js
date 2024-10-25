/* global google, sageVars */
function initMap(mapElement) {
  var markers = mapElement.querySelectorAll('.wp-block-locations__map__marker');

  var mapArgs = {
    zoom        : parseInt(mapElement.getAttribute('data-zoom') || 16),
    mapTypeId   : google.maps.MapTypeId.ROADMAP,
  };
  var map = new google.maps.Map(mapElement, mapArgs);

  map.markers = [];
  for(var i = 0; i < markers.length; i++){
    initMarker(markers[i], map);
  }

  centerMap(map);

  return map;
}

function initMarker(markerElement, map) {

  var lat = markerElement.getAttribute('data-lat');
  var lng = markerElement.getAttribute('data-lng');

  var latLng = {
    lat: parseFloat(lat),
    lng: parseFloat(lng),
  };

  const marker = new google.maps.Marker({
    position : latLng,
    map: map,
  });

  map.markers.push(marker);

  if(markerElement.innerHTML.trim() !== ""){
    var infowindow = new google.maps.InfoWindow({
      content: markerElement.innerHTML,
    });

    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map, marker);
    });
  }
}

function centerMap(map) {

  var bounds = new google.maps.LatLngBounds();
  map.markers.forEach(function(marker){
    bounds.extend({
      lat: marker.position.lat(),
      lng: marker.position.lng(),
    });
  });

  if(map.markers.length == 1){
    map.setCenter(bounds.getCenter());

  } else{
    map.fitBounds(bounds);
  }
}


window.initMap = function(){
  const maps = document.querySelectorAll('.wp-block-locations__map');
  for (let i = 0; i < maps.length; i++) {
    const map = maps[i];
    initMap(map);
  }
}

// Load Google Maps API script after initMap is defined
var script = document.createElement('script');
script.src = 'https://maps.googleapis.com/maps/api/js?key=' + sageVars.googleMapsKey + '&callback=initMap';
script.async = true;
document.head.appendChild(script);
