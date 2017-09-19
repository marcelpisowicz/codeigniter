<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Auth_Controller
{

    public function index()
    {
//        $query = $this->db->query('SELECT * FROM drones');
//
//        $this->table->set_heading('ID code', 'model', 'active');

//        $this->load->model('login_model');

        $this->data['drones'] = Drone::get_drone_list();

        $this->render('home/index_view');

    }
}