<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data = [];

    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'CI App';
        $this->data['page_description'] = 'CI_App';
        $this->data['before_closing_head'] = '';
        $this->data['before_closing_body'] = '';
        $this->table->set_template(['table_open'  => '<table class="datatable">']);
    }

    protected function render($the_view = null, $template = 'public_master')
    {
        if ($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        } elseif (is_null($template)) {
            $this->load->view('templates/styles');
            $this->load->view($the_view, $this->data);
        } else {
            $this->load->view('templates/styles');
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, true);
            $this->load->view('templates/' . $template . '_view', $this->data);
        }
    }
}

class Auth_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        if ($this->ion_auth->logged_in() === false) {
            $this->session->set_userdata('url', uri_string());
            redirect('login');
        }
    }

    protected function render($the_view = null, $template = 'auth_master')
    {
        parent::render($the_view, $template);
    }
}