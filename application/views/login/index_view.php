<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/login.css') ?>"/>
<body class="main">
<div class="login-center">
    <?= form_open(); ?>
    <div class="front signin_form">
        <p class="login_text">Login your account</p>

        <div class="input-group">
            <?= form_input('username', $username, ['class' => 'form-control', 'placeholder' => 'username']) ?>
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        </div>
        <div class="input-group">
            <?= form_password('password', '', ['class' => 'form-control', 'placeholder' => 'password']) ?>
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        </div>
        <div class="form-group sign-btn">
            <input type="submit" class="btn" value="Log in">
            <div class="checkbox">
                <label class="checkbox_label">
                    <input type="checkbox" name="remember">
                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                    <span class="checkbox_label">Remember me</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <p><a href="#" >Can't access your account?</a></p>
            <p><strong>New here?</strong><br>
                <a href="/register">Sign up for a new account</a>
            </p>
        </div>
    </div>
</div>
</body>