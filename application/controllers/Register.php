<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller
{

    public function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|max_length[20]|required');
        $this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|matches[password]|required');

        if ($this->form_validation->run() === false) {
            $this->data['username'] = $this->input->post('username');
            $this->data['email'] = $this->input->post('email');
            $this->data['password'] = $this->input->post('password');
            $this->load->helper('form');
            $this->render('register/index_view');
        } else {
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $this->load->library('ion_auth');

            if ($this->ion_auth->register($username, $password, $email)) {
                $_SESSION['auth_message'] = 'The account has been created. You may now login.';
                $this->session->mark_as_flash('auth_message');
                redirect('login');
            } else {
                $_SESSION['auth_message'] = $this->ion_auth->errors();
                $this->session->mark_as_flash('auth_message');
                redirect('register');
            }
        }
    }
}