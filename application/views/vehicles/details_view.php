<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?= form_open(); ?>
<?= form_hidden('id', $model['id']); ?>
<table class="details_table">
    <thead>
    <tr>
        <th colspan="2"><?= _('Informacje podstawowe') ?></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= _('Nazwa') ?></td>
        <td><?= form_input('name', $model['name']); ?></td>
    </tr>
    <tr>
        <td><?= _('Numer rejestracyjny') ?></td>
        <td><?= form_input('serial_number', $model['serial_number']); ?></td>
    </tr>
    <tr>
        <td><?= _('Model') ?></td>
        <td><?= form_input('model', $model['model']); ?></td>
    </tr>
    <tr>
        <td><?= _('Typ') ?></td>
        <td><?= form_dropdown('type', $vehicle_types, $model['type']); ?></td>
    </tr>
    <tr>
        <td><?= _('Źródło streama')?></td>
        <td><?= form_input('stream_source', $model['stream_source']); ?></td>
    </tr>
    <tr>
        <td><?= _('Aktywny')?></td>
        <td><?= form_checkbox('active', $model['active']); ?></td>
    </tr>
    <tr>
        <td><?= _('Aktywny')?></td>
        <td><?= form_textarea('description', $model['description']); ?></td>
    </tr>
    </tbody>
</table>
<?= form_close(); ?>

