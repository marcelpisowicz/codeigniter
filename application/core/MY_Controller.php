<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data = [];
    protected $menu;

    function __construct()
    {
        parent::__construct();
        $this->menu = new Menu();
        $this->data['page_title'] = 'Drone Management System';
        $this->data['page_description'] = 'Drone Management System';
        $this->data['before_closing_head'] = '';
        $this->data['before_closing_body'] = '';
    }

    protected function render($the_view = null, $template = 'public_master')
    {
        $this->data['menu'] = $this->menu->render_menu();
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

class Menu
{
    protected $menu_items = [];

    public function add_menu($url, $icon, $name = null)
    {
        $class = strtolower(str_replace(' ', '_', $name));
        $this->menu[] = [
            'url' => $url,
            'icon' => $icon,
            'name' => $name,
            'class' => $class
        ];
    }

    public function add_new()
    {
        $this->add_menu(get_path().'/details', '/assets/icons/new.png', 'New');
    }

    public function add_save()
    {
        $this->add_menu('javascript: submitForm()', '/assets/icons/save.png', 'Save');
    }

    public function add_delete()
    {
        $this->add_menu('javascript: submitDelete()', '/assets/icons/trash.png', 'Delete');
    }

    public function render_menu() {
        $html = '<div id="left_menu">';
        foreach ($this->menu as $item) {
            $html .= '<a href="'.$item['url'].'" class="new_button '.$item['class'].'" title="'.$item['name'].'"><img class="left_menu_item" src='.$item['icon'].'></a>';
        }
        $html .= '</div>';
        return $html;
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