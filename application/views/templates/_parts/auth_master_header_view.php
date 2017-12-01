<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?= $page_title; ?></title>
    <meta name="description" value="<?= $page_description; ?>"/>
    <script src="/assets/js/main.js"></script>
    <?= $before_closing_head; ?>
</head>
<body>
<nav id="main_nav" class="navbar-inverse">
    <div class="menubar">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only"> Toggle navigation</span>
            <span class="icon-bar"> </span>
            <span class="icon-bar"> </span>
            <span class="icon-bar"> </span>
        </button>

        <a href="/">
            <div id="page_logo"></div>
        </a>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/drones"><?= _('Drony') ?></a></li>
                <li><a href="/routes"><?= _('Trasy') ?></a></li>
                <li><a href="/users"><?= _('Użytkownicy') ?></a></li>
                <!--                <li class="dropdown">-->
                <!--                    <a href="#" class="dropdown-toggle"-->
                <!--                       data-toggle="dropdown"> Learn-->
                <!--                        <ul class="dropdown-menu">-->
                <!--                            <li class="dropdown-header">Example</li>-->
                <!--                            <li><a href="#"> c++</a></li>-->
                <!--                            <li><a href="#"> java</a></li>-->
                <!--                            <li class="dropdown-header">tutorials</li>-->
                <!--                            <li><a href="#"> c++</a></li>-->
                <!--                            <li><a href="#"> java</a></li>-->
                <!--                        </ul>-->
                <!--                </li>-->
                <li><?= anchor('logout', _('Wyloguj')); ?></li>
            </ul>
        </div>
    </div>
</nav>
<div class="nav-margin"></div>

<script>
    $(document).ready(function () {

        <?php if(!empty($selected_menu)) : ?>
        $('.navbar-nav li a[href^="/<?= $selected_menu ?>"]').addClass('active');
        <?php endif; ?>

        <?php if (!empty($alert)) : ?>

        $('body').append('<?= $alert; ?>');
        $('#alert_box').fadeIn().delay(5000).fadeOut();

        $('#close_alert').click(function (e) {
            $(this).closest('#alert_box').stop().fadeOut();
        });
        <?php endif; ?>
    });
</script>
