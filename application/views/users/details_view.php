<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?= form_open(); ?>
<?= form_hidden('id', $id); ?>
<?= form_hidden('previous_email', $model['email']); ?>
<table class="details_table">
    <thead>
    <tr>
        <th colspan="2"><?= _('Informacje podstawowe') ?></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= _('Nazwa użytkownika') ?></td>
        <td><?= form_input('username', $model['username']); ?></td>
    </tr>
    <tr>
        <td><?= _('Hasło') ?></td>
        <td><?= form_password('password'); ?></td>
    </tr>
    <tr>
        <td><?= _('Email') ?></td>
        <td><?= form_input('email', $model['email']); ?></td>
    </tr>
    <tr>
        <td><?= _('Język') ?></td>
        <td><?= form_dropdown('lang', arr_form($languages), $model['lang']); ?></td>
    </tr>
    <tr>
        <td><?= _('Aktywny')?></td>
        <td><?= form_checkbox('active', $model['active']); ?></td>
    </tr>
    <tr>
        <td><?= _('Utworzono') ?></td>
        <td><?= form_input(null, $model['created'], 'readonly'); ?></td>
    </tr>
    <tr>
        <td><?= _('Zmodyfikowano') ?></td>
        <td><?= form_input(null, $model['updated'], 'readonly'); ?></td>
    </tr>
    <tr>
        <td><?= _('Ostatnio aktywny') ?></td>
        <td><?= form_input(null, $model['last_login'], 'readonly'); ?></td>
    </tr>
    </tbody>
</table>
<?= form_close(); ?>

