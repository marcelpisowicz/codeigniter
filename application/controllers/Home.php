<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Auth_Controller
{

    public function index()
    {
        $drones = Drone::all()->toArray();
        $this->data['drones'] = $drones;
        $this->table->set_heading(['id_code', 'model']);
        $this->table->add_action('delete', '/home/delete', '/assets/icons/gps.png');
        $this->table->add_action('delete', '/home/delete', '/assets/icons/location.png');
        $this->table->add_action('delete', '/home/delete', '/assets/icons/fullscreen.png');
        $this->table->add_action('delete', '/home/delete', '/assets/icons/document.png');
        $this->table->add_action('delete', '/home/delete', '/assets/icons/analyze.png');
        $this->table->add_action('delete', '/home/delete', '/assets/icons/trash.png');

        $this->data['table'] = $this->table->generate($drones);

        $this->render('home/index_view');
    }
}