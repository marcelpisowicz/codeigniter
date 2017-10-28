<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/_parts/auth_master_header_view'); ?>
<?= $menu ?>
    <div id="content">
        <?= $the_view_content ?>
    </div>
<?php $this->load->view('templates/_parts/auth_master_footer_view'); ?>