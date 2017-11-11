<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
    html,body {
        height:100%;
        overflow-y: hidden;
    }
    #map_div {
        width: 100%;
        height: 100%;
        padding-bottom: 150px;
    }
    #route_name {
        color: black;
        margin-bottom: 10px;
    }

</style>

<?= form_open('routes/save'); ?>
<?= form_hidden('id', $id); ?>
<?= form_hidden('route', null); ?>

<div id="map_div">
    <div id="route_name">Nazwa trasy: <?= form_input('name', $name); ?></div>
    <div id="map" style="height: 100%;width: 100%"></div>
</div>

<?= form_close(); ?>

<script>

    $('.save').on('click', function(e) {
        e.preventDefault();

        var points = JSON.stringify(poly.getPath().getArray());

//        for (var i = 0; i < paths.length; i++) {
//            lat = paths[i].lat();
//            lng = paths[i].lng();
//        }

        $("input[name*='route']").val(points);
        submitForm();
    });
    // This example creates an interactive map which constructs a polyline based on
    // user clicks. Note that the polyline only appears once its path property
    // contains two LatLng coordinates.

    var poly;
    var map;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: 51.110, lng: 17.055}  // Center the map on Chicago, USA.
        });

        poly = new google.maps.Polyline({
            strokeColor: '#000000',
            strokeOpacity: 1.0,
            strokeWeight: 3
        });
        poly.setMap(map);

        // Add a listener for the click event
        map.addListener('click', addLatLng);
    }

    // Handles click events on a map, and adds a new point to the Polyline.
    function addLatLng(event) {
        var path = poly.getPath();

        // Because path is an MVCArray, we can simply append a new coordinate
        // and it will automatically appear.
        path.push(event.latLng);

        // Add a new marker at the new plotted point on the polyline.
        var marker = new google.maps.Marker({
            position: event.latLng,
            title: '#' + path.getLength(),
            map: map
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?= MAP_API_KEY ?>&callback=initMap">
</script>

