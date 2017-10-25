<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="left_menu">
    <a href="#" class="new_button"><img class="left_menu_item" src=/assets/icons/new.png></a>
    <a href="#" class="new_button"><img class="left_menu_item" src=/assets/icons/settings.png></a>
</div>
<div class="content">

    <?= form_open('home/save'); ?>
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
            <td><?= form_input('id_code', $drone['model']); ?></td>
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
</div>
