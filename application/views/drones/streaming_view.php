<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= _('Streaming video') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= base_url('assets/css/flowplayer/skin.css') ?>"/>
    <script src="<?= base_url('assets/js/flowplayer.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/flowplayer.hlsjs.light.min.js') ?>"></script>
</head>

<body>
<?php if (empty($source)) : ?>
<div style="width: 100%;height:100%;text-align: center; font-size: 20px; color: red;background: rgba(255, 255, 255, 0.65);"; >
    <span><?= _('Brak zdefiniowanego źródła wideo w szczegółach urządzenia') ?></span>
</div>

<?php else: ?>

    <div data-live="true" data-share="false" class="flowplayer" style="width:100%; height: 100%">
        <video autoplay data-title="Live stream">
            <source type="application/x-mpegurl"
                    src="<?= $source ?>">
        </video>
    </div>
<?php endif; ?>

</body>
</html>