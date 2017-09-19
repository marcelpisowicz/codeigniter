<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Auth_Controller
{

    public function index()
    {
        $this->data['drones'] = Drone::all()->toArray();
        $this->render('home/index_view');
    }
}