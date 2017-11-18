<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data = [];
    protected $menu_items = [];
    protected $class;

    function __construct()
    {
        parent::__construct();
        $this->class = $this->router->class;
        $this->data['page_title'] = 'Drone Management System';
        $this->data['page_description'] = 'Drone Management System';
        $this->data['before_closing_head'] = '';
        $this->data['before_closing_body'] = '';
    }

    protected function redirect($id = null)
    {
        if(!empty($id)) {
            redirect('/' . $this->class . '/details/' . (int)$id);
        } else {
            redirect('/' . $this->class);
        }
    }

    protected function render($the_view = null, $template = 'public_master')
    {
        $this->data['alert'] = $this->render_alert();
        $this->data['menu'] = $this->render_menu();
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

    private function render_alert()
    {
        if(!empty($this->session->message)) {
            $message = $this->session->message;

            switch($message['type']) {
                case SUCCESS:
                    $class = 'success';
                    $header = _('Sukces');
                    break;
                case WARNING:
                    $class = 'warning';
                    $header = _('Ostrzeżenie');
                    break;
                case ERROR:
                    $class = 'error';
                    $header = _('Błąd');
                    break;
                default:
                    $class = 'notice';
                    $header = _('Informacja');
                    break;
            }

            $html = '<div id="alert_box" class="alert '.$class.'">'
            .'<button type="button" class="close">×</button>'
            .'<h4>'.$header.'!</h4>'
            .'<p>'.$message['text'].'</p></div>';
            unset($_SESSION['message']);
            return $html;
        }
    }

    public function add_menu($url, $icon, $name = null)
    {
        $class = strtolower(str_replace(' ', '_', $name));
        $this->menu_items[] = [
            'url' => $url,
            'icon' => $icon,
            'name' => $name,
            'class' => $class
        ];
    }

    public function add_menu_new()
    {
        $this->add_menu(get_path().'/details', '/assets/icons/new.png', 'New');
    }

    public function add_menu_save()
    {
        $this->add_menu('javascript: submitForm()', '/assets/icons/save.png', 'Save');
    }

    public function add_menu_delete($id)
    {
        if(!empty($id)) {
            $url = '/'.$this->class . '/delete/' . (int)$id;
            $this->add_menu($url, '/assets/icons/trash.png', 'Delete');
        }
    }

    public function add_menu_return()
    {
        $this->add_menu( '/'.$this->class, '/assets/icons/return.png', 'Return');
    }

    public function render_menu() {
        $html = '<div id="left_menu">';
        foreach ($this->menu_items as $item) {
            $html .= '<a href="'.$item['url'].'" class="new_button '.$item['class'].'" title="'._($item['name']).'"><img class="left_menu_item" src='.$item['icon'].'></a>';
        }
        $html .= '</div>';
        return $html;
    }

    public function model($model) {
        $model = $model->toArray();
        $this->data['model'] = empty($model) ? null : $model;
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