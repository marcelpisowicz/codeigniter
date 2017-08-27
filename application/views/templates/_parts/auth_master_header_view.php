<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?php echo $page_title; ?></title>
    <meta name="description" value="<?php echo $page_description; ?>"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <?php echo $before_closing_head; ?>
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

        <a class="navbar-brand" href="#">Bootsnipp</a>

        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class=""><a href="#">Profile</a></li>
                <li><a href="#">about</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"
                       data-toggle="dropdown"> Learn
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Example</li>
                            <li><a href="#"> c++</a></li>
                            <li><a href="#"> java</a></li>
                            <li class="dropdown-header">tutorials</li>
                            <li><a href="#"> c++</a></li>
                            <li><a href="#"> java</a></li>
                        </ul>
                </li>
                <li><?php echo anchor('logout', 'Logout'); ?></li>
            </ul>
        </div>
    </div>
</nav>
<div class="nav-margin"></div>
