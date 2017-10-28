<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?= form_open('home/save'); ?>
<?= form_hidden('id', $id); ?>
<table id="details_table">
    <thead>
    <tr>
        <th colspan="2">Informacje podstawowe</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Identyfikator drona</td>
        <td><?= form_input('id_code', $drone['id_code']); ?></td>
    </tr>
    <tr>
        <td>Model</td>
        <td><?= form_input('model', $drone['model']); ?></td>
    </tr>
    <tr>
        <td>Aktywny</td>
        <td>
            <?= form_checkbox('active', $drone['active']); ?>
        </td>
    </tr>
    </tbody>
</table>
<?= form_close(); ?>

