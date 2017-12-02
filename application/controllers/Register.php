<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller
{
    public function index()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        $min_length = $this->config->item('min_password_length', 'ion_auth');
        $max_length = $this->config->item('max_password_length', 'ion_auth');

        $this->form_validation->set_rules('username', 'Username',
            'trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email',
            'trim|valid_email|required');
        $this->form_validation->set_rules('password', 'Password',
            'trim|min_length['.$min_length.']|max_length['.$max_length.']|required');
        $this->form_validation->set_rules('confirm_password', 'Confirm password',
            'trim|matches[password]|required');

        if(!empty($this->input->post()) && $this->form_validation->run() !== false) {

            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $this->load->library('ion_auth');

            if ($this->ion_auth->register($username, $password, $email)) {
                $manual_activation = $this->config->item('manual_activation', 'ion_auth');
                if($manual_activation) {
                    alert('Konto zostało utworzone.
                    Po aktywowaniu przez administratora będziesz mógł się zalogować.', NOTICE);
                } else {
                    alert('Konto zostało utworzone. Możesz się zalogować.', SUCCESS);
                }
                redirect('login');
            } else {
                alert($this->ion_auth->errors(), ERROR);
            }
        } elseif (!empty($this->input->post())) {
            alert('Niewłaściwe dane rejestracji', ERROR);
        }

        $this->render('register/index_view');
    }
}

