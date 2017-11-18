<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/login.css') ?>"/>
<body class="main">
<div class="login-center">
    <?= form_open(); ?>
    <div class="front signin_form">
        <p class="login_text"><?= _('Rejestracja nowego konta') ?></p>

        <div class="input-group">
            <?= form_input('username', $username, ['class' => 'form-control'.(empty(form_error('username')) ? '' : ' error-form'), 'placeholder' => 'username']) ?>
            <span class="input-group-addon<?= empty(form_error('username')) ? '' : ' error-form' ?>"><i class="glyphicon glyphicon-user"></i></span>
        </div>
        <div class="input-group">
            <?= form_input('email', $email, ['class' => 'form-control'.(empty(form_error('email')) ? '' : ' error-form'), 'placeholder' => 'email']) ?>
            <span class="input-group-addon<?= empty(form_error('email')) ? '' : ' error-form' ?>"><i class="glyphicon glyphicon-envelope"></i></span>
        </div>
        <div class="input-group">
            <?= form_password('password', $password, ['id' => 'password', 'class' => 'form-control'.(empty(form_error('password')) ? '' : ' error-form'), 'placeholder' => 'password']) ?>
            <span class="input-group-addon<?= empty(form_error('password')) ? '' : ' error-form' ?>"><i class="glyphicon glyphicon-lock"></i></span>
        </div>
        <div class="input-group">
            <?= form_password('confirm_password', '', ['id' => 'confirm_password', 'class' => 'form-control'.(empty(form_error('confirm_password')) ? '' : ' error-form'), 'placeholder' => 'confirm password']) ?>
            <span class="input-group-addon<?= empty(form_error('confirm_password')) ? '' : ' error-form' ?>"><i class="glyphicon glyphicon-remove"></i></span>
        </div>

        <div class="form-group sign-btn">
            <input type="submit" class="btn" value="Register">
        </div>

        <div class="form-group">
            <p><a href="/user/login" ><?= _('Zaloguj') ?></a></p>
        </div>

    </div>
</div>
</body>
<script>
    $(document).ready(function() {
        $('#confirm_password, #password').keyup(function(){
            var confirm = $('#confirm_password');
            if($('#password').val() === confirm.val() && confirm.val()) {
                $('.glyphicon-remove').removeClass('glyphicon-remove').addClass('glyphicon-ok');
            } else {
                $('.glyphicon-ok').removeClass('glyphicon-ok').addClass('glyphicon-remove');
            }
        });

        $('.form-control').focus(function() {
            $(this).removeClass('error-form');
            $(this).closest('.input-group').find('.input-group-addon').removeClass('error-form');
        });
    });
</script>