<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
    html,body {
        height:100%;
        overflow-y: hidden;
    }
    #map_div {
        width: 100%;
        height: 100%;
        padding-bottom: 180px;
    }
    #route_details {
        color: black;
        margin-bottom: 10px;
        width: 100%;
    }

</style>
<script src="<?= base_url('assets/js/google_maps.js') ?>"></script>

<?= form_open(); ?>
<?= form_hidden('id', $id); ?>
<?= form_hidden('route', null); ?>

<table id="route_details">
    <tr>
        <td>Nazwa Trasy:</td>
        <td><?= form_input('name', $route['name']); ?></td>
        <td style="text-align: right;font-size: 12px;">
            <?php if(!empty($creator['id'])): ?>
            Utworzył: <?= $creator['username'] ?> <br> <?= $creator['email'] ?>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td>Opis trasy:</td>
        <td colspan="2"><?= form_textarea('description', $route['description'], ['style' => 'height:50px;width:100%']); ?></td>
    </tr>
</table>

<div id="map_div">
    <div id="map" style="height: 100%;width: 100%"></div>
</div>

<?= form_close(); ?>

<script>

    $(document).ready(function () {

        initMap();

        $('.save').on('click', function(e) {
            e.preventDefault();

            var points = JSON.stringify(poly.getPath().getArray());
            if(points.length > 0) {
                $("input[name*='route']").val(points);
            }
            submitForm();
        });

    });

    // This example creates an interactive map which constructs a polyline based on
    // user clicks. Note that the polyline only appears once its path property
    // contains two LatLng coordinates.

    var poly;
    var map;

    function initMap() {

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: <?= $center_lat; ?>, lng: <?= $center_lng; ?>}
        });

        poly = new google.maps.Polyline({
            strokeColor: '#000000',
            strokeOpacity: 1.0,
            strokeWeight: 3
        });
        poly.setMap(map);

        map.addListener('click', addLatLng);

        //Rysowanie obecnej trasy, jesli istnieje
        <?php if(!empty($id) && isset($route_points)) : ?>
        var currentRoute = <?= $route_points ?>;
        var polylineRoute = new google.maps.Polyline({
            path: currentRoute,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });
        polylineRoute.setMap(map);
        <?php endif; ?>
    }

    function addLatLng(event) {
        var path = poly.getPath();
        path.push(event.latLng);

        var marker = new google.maps.Marker({
            position: event.latLng,
            title: '#' + path.getLength(),
            map: map
        });
    }
</script>
