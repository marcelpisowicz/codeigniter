<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/login.css') ?>"/>
<body class="main">
<div class="login-center">
    <?= form_open('login'); ?>
    <div class="front signin_form">
        <p class="login_text"><?= _('Logowanie') ?></p>

        <div class="input-group">
            <?= form_input('username', $username, ['class' => 'form-control login_input', 'placeholder' => _('nazwa użytkownika')]) ?>
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        </div>
        <div class="input-group">
            <?= form_password('password', '', ['class' => 'form-control login_input', 'placeholder' => _('hasło')]) ?>
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        </div>
        <div class="form-group sign-btn">
            <input type="submit" class="btn" value="<?= _('Zaloguj') ?>">
            <div class="checkbox remember_me">
                <label class="checkbox_label">
                    <input type="checkbox" name="remember">
                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                    <span class="checkbox_label"><?= _('Zapamiętaj mnie') ?></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <p><strong><?= _('Nie masz konta?')?></strong><br>
                <a href="/register"><?= _('Rejestracja') ?></a>
            </p>
        </div>
    </div>
</div>
</body>