<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data = [];
    protected $menu_items = [];
    protected $header;
    protected $description;
    protected $class;

    function __construct()
    {
        parent::__construct();
        $this->class = $this->router->class;
        $this->data['page_title'] = 'Vehicle Management System';
        $this->data['page_description'] = 'Vehicle Management System';
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
        $this->data['header'] = $this->render_header();
        $this->data['alert'] = $this->render_alert();
        $this->data['menu'] = $this->menu_items;
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

    private function render_header()
    {
        $html = '';
        if(!empty($this->header)) {
            $html .= '<strong>'.$this->header.'</strong>';
        }
        if(!empty($this->header) && !empty($this->description)) {
            $html .= ' | ';
        }
        if(!empty($this->description)) {
            $html .= $this->description;
        }
        return $html;
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

    public function add_menu($url, $icon, $name = null, $class = null)
    {
        $this->menu_items[] = [
            'url' => $url,
            'icon' => $icon,
            'name' => $name,
            'class' => $class
        ];
    }

    public function add_header($text)
    {
        $this->header = $text;
    }

    public function add_description($text)
    {
        $this->description = $text;
    }

    public function add_menu_new($path = null)
    {
        if(empty($path)) {
            $path = get_path().'/details';
        }
        $this->add_menu($path, '/assets/icons/new.png', _('Nowy'), 'new');
    }

    public function add_menu_save()
    {
        $this->add_menu('javascript: submitForm()', '/assets/icons/save.png', _('Zapisz'), 'save');
    }

    public function add_menu_delete($id)
    {
        if(!empty($id)) {
            $url = '/'.$this->class . '/delete/' . (int)$id;
            $this->add_menu($url, '/assets/icons/trash.png', _('Usuń'), 'delete');
        }
    }

    public function add_menu_return($path = null)
    {
        if(empty($path)) {
            $path = '/'.$this->class;
        }
        $this->add_menu($path, '/assets/icons/return.png', _('Powrót'), 'return');
    }

    public function model($model, $nazwa = 'model') {
        if(!empty($model)) {
            $model = $model->toArray();
        }
        $this->data[$nazwa] = empty($model) ? null : $model;
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