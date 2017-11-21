<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/_parts/auth_master_header_view'); ?>

    <div id="left_menu">
        <?php foreach ($menu as $item) : ?>
            <a href="<?= $item['url'] ?>" class="new_button <?= $item['class'] ?>" title="<?= _($item['name']) ?>">
                <img class="left_menu_item" src="<?= $item['icon'] ?>">
            </a>
        <?php endforeach; ?>
    </div>

    <div id="content">
        <div id="content_title"><?= $header ?></div>
        <?= $the_view_content ?>
    </div>
<?php $this->load->view('templates/_parts/auth_master_footer_view'); ?>