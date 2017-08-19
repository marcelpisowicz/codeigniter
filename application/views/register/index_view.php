<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
    <?php
    echo isset($_SESSION['auth_message']) ? $_SESSION['auth_message'] : false;
    ?>
    <h1>Register</h1>
    <?php
    echo form_open();
    echo form_label('Username:','username').'<br />';
    echo form_error('username');
    echo form_input('username',set_value('username')).'<br />';
    echo form_label('Email:','email').'<br />';
    echo form_error('email');
    echo form_input('email',set_value('email')).'<br />';
    echo form_label('Password:', 'password').'<br />';
    echo form_error('password');
    echo form_password('password').'<br />';
    echo form_label('Confirm password:', 'confirm_password').'<br />';
    echo form_error('confirm_password');
    echo form_password('confirm_password').'<br /><br />';
    echo form_submit('register','Register');
    echo form_close();
    ?>
</div>