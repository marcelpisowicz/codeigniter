<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routes extends Auth_Controller
{

    public function index()
    {

    }

    public function create($id = null)
    {
//        $drone = Drone::find($id);
        $this->data['id'] = $id;
        $this->data['name'] = 'Trasa testowa';

        $this->add_menu('/', '/assets/icons/return.png', 'Return');
        $this->add_save();
        $this->add_delete();

        $this->render('routes/create_view');
    }

    public function save()
    {
        $post = $this->input->post();
        $points = json_decode($post['route'], true);
        
        var_dump($points); die;

    }

}