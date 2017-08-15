<?php
/**
 * Created by PhpStorm.
 * User: marce
 * Date: 15.08.2017
 * Time: 15:24
 */

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('welcome');
        }
    }
}