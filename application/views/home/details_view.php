<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?= form_open(); ?>
<?= form_hidden('id', $id); ?>
<table id="details_table">
    <thead>
    <tr>
        <th colspan="2"><?= _('Informacje podstawowe') ?></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= _('Identyfikator drona') ?></td>
        <td><?= form_input('id_code', $drone['id_code']); ?></td>
    </tr>
    <tr>
        <td><?= _('Model') ?></td>
        <td><?= form_input('model', $drone['model']); ?></td>
    </tr>
    <tr>
        <td><?= _('Typ') ?></td>
        <td><?= form_dropdown('type', $drone_types, $drone['type']); ?></td>
    </tr>
    <tr>
        <td><?= _('Źródło streama')?></td>
        <td><?= form_input('stream_source', $drone['stream_source']); ?></td>
    </tr>
    <tr>
        <td><?= _('Aktywny')?></td>
        <td><?= form_checkbox('active', $drone['active']); ?></td>
    </tr>
    </tbody>
</table>
<?= form_close(); ?>

