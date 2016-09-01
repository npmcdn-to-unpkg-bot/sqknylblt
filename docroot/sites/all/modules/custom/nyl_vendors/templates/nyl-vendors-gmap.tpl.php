<?php
/**
 * @file
 * Contains nyl-vendors-gmap.tpl.php
 */
$language = 'en';
?>

<div id="nyl-vendors-gmap">

<script src="https://googlemaps.github.io/js-marker-clusterer/src/markerclusterer.js"></script>
<div class="vendor_gmap_element">
  <div id="vendor_gmap_markers" data-markers='<?php print htmlspecialchars(json_encode($markers), ENT_QUOTES, 'UTF-8'); ?>' ></div>
  <div id="map_canvas" class="vendors_map" style="width:640px; height:640px;">Enable Javascript to display the Google Map.</div>
</div>
<?php print_r($events); ?>

<script type="text/javascript">
//<!--
  // HTML data-* Attributes
  var json = document.getElementById('vendor_gmap_markers').dataset.markers;
  var data = JSON.parse(json);
  //    var iconLotto = new GIcon();
  //    iconLotto.image = 'http://nylottery.ny.gov/Common-Files/res/img/NYL_locator_marker.png';
  //    iconLotto.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
  //    iconLotto.iconSize = new GSize(32, 46);
  //    iconLotto.shadowSize = new GSize(22, 20);
  //    iconLotto.iconAnchor = new GPoint(6, 20);
  //    iconLotto.infoWindowAnchor = new GPoint(5, 1);
  var map;
  var markers;

  function initMap() {
    var myOptions = {
      zoom: <?php print variable_get('nyl_vendors_zoom', 15); ?>,
      center: new google.maps.LatLng(<?php print $center['lat']; ?>, <?php print $center['lon']; ?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    markers = [];

    // TODO NYL png is too small
    // var image = 'http://nylottery.ny.gov/Common-Files/res/img/NYL_locator_marker.png';
    // var imageHot = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';

    for (key in data) {
      var latLng = new google.maps.LatLng(data[key]['latitude'], data[key]['longitude']);
      var image = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
      if ( data[key]['hot'] ) {  // Lucky Vendor (aka Hot)
        image = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
      }
      var marker = new google.maps.Marker({
        'id': key,
        'map': map,
        'position': latLng,
        'icon': image,
        'content': data[key]['name']
      });

      // https://developers.google.com/maps/documentation/javascript/infowindows#open
      // http://stackoverflow.com/questions/5736691/google-maps-infowindow-showing-on-wrong-marker
      google.maps.event.addListener(marker, 'click', function(e) {
        new google.maps.InfoWindow({
          content: this.id +': '+ this.content
        }).open(map, this);
      });
      markers.push(marker);
    }
    var markerCluster = new MarkerClusterer(map, markers);

    //
    //    var rectangle = new google.maps.Rectangle({
    //      strokeColor: '#FF0000',
    //      strokeOpacity: 0.8,
    //      strokeWeight: 2,
    //      fillColor: '#FF0000',
    //      fillOpacity: 0.35,
    //      map: map,
    //      bounds: {
    //        'north': <?php //print $bounds['north']; ?>//,
    //        'south': <?php //print $bounds['south']; ?>//,
    //        'east': <?php //print $bounds['east']; ?>//,
    //        'west': <?php //print $bounds['west']; ?>
    //      }
    //    });
  }
  //    function toggleBounce() {
  //        if (marker.getAnimation() !== null) {
  //            marker.setAnimation(null);
  //        } else {
  //            marker.setAnimation(google.maps.Animation.BOUNCE);
  //        }
  //    }
  function panToAndZoom(lat, long) {
    document.getElementById('map_canvas').scrollIntoView();
    var zoom = map.getZoom();
    map.panTo(new google.maps.LatLng(lat, long));
    if (zoom < 16) {
      map.setZoom(16);
    }
  }
// -->
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php print GMAP_API_KEY; ?>&callback=initMap&language=<?php print $language; ?>&region=US"
        async defer></script>