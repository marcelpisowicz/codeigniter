<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Flowplayer · Live stream</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= base_url('assets/css/flowplayer/skin.css') ?>"/>
    <script src="<?= base_url('assets/js/flowplayer.min.js') ?>"></script>
<!--    <script src="--><?//= base_url('assets/js/flowplayer.hlsjs.light.min.js') ?><!--"></script>-->
    <script src="<?= base_url('assets/js/flowplayer.hlsjs.js') ?>"></script>

</head>

<body>

<div data-live="true" data-ratio="0.5625" data-share="false" class="flowplayer">

    <video autoplay data-title="Live stream">
        <source type="application/x-mpegurl"
                src="https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8">
    </video>

</div>

</body>
</html>