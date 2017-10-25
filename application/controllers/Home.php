<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Auth_Controller
{

    public function index()
    {
        $drones = Drone::all()->toArray();
        $this->data['drones'] = $drones;
        $this->table->set_heading(['id_code', 'model']);
        $this->table->add_action('delete', '/home/gps', '/assets/icons/gps.png');
        $this->table->add_action('delete', '/home/location', '/assets/icons/location.png');
        $this->table->add_action('delete', '/streaming/index', '/assets/icons/fullscreen.png', [900, 450]);
        $this->table->add_action('details', '/home/details', '/assets/icons/document.png');
        $this->table->add_action('delete', '/home/analyze', '/assets/icons/analyze.png');
        $this->table->add_action('delete', '/home/delete', '/assets/icons/trash.png');

        $this->data['table'] = $this->table->generate($drones);

        $this->render('home/index_view');
    }

    public function details($id = null)
    {
        $drone = Drone::find($id)->toArray();

        $this->data['drone'] = $drone;
        $this->render('home/details_view');
    }
}