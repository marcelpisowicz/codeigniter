<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .scheduler_table tr td {
        width: 0;
    }
</style>
<?= form_open(); ?>
<?= form_hidden('drone_id', $drone['id']); ?>
<table class="details_table scheduler_table">
    <thead>
    <tr>
        <th colspan="3"><?= _('Informacje podstawowe') ?></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= _('Dron') ?></td>
        <td colspan="2"><?= form_input(null, $drone['name'], 'readonly'); ?></td>
    </tr>
    <tr>
        <td><?= _('Trasa') ?></td>
        <td colspan="2"><?= form_dropdown('route_id', $route_select, $model['route_id']); ?></td>
    </tr>
    <tr>
        <td><?= _('Dzień tygodnia') ?></td>
        <td><?= form_input('day_of_week', $model['day_of_week']); ?></td>
        <td>[0 - 6]</td>
    </tr>
    <tr>
        <td><?= _('Miesiąc') ?></td>
        <td><?= form_input('month', $model['month']); ?></td>
        <td>[1 - 12]</td>
    </tr>
    <tr>
        <td><?= _('Dzień') ?></td>
        <td><?= form_input('day', $model['day']); ?></td>
        <td>[0 - 31]</td>
    </tr>
    <tr>
        <td><?= _('Godzina') ?></td>
        <td><?= form_input('hour', $model['hour']); ?></td>
        <td>[0 - 23]</td>
    </tr>
    <tr>
        <td><?= _('Minuta') ?></td>
        <td><?= form_input('minute', $model['minute']); ?></td>
        <td>[0 - 59]</td>
    </tr>
    <tr>
        <td><?= _('Opis') ?></td>
        <td colspan="2"><?= form_textarea('description', $model['description'], ['style' => 'height:80px']); ?></td>
    </tr>
    </tbody>
</table>
<?= form_close(); ?>

