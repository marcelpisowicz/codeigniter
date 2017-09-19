<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Auth_Controller
{

    public function index()
    {
        $orm = new Drone();
        $drones = $orm->all();

        if($orm->has_result()) {
            $this->data['drones'] = $drones;
        }

        $this->data['drones'] = $orm->all();

        $this->render('home/index_view');

    }
}