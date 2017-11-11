<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Auth_Controller
{

    public function index()
    {
        $drones = Drone::all()->toArray();
        $this->data['drones'] = $drones;
        $this->table->set_heading(['id_code', 'model']);
//        $this->table->add_action('/home/gps', '/assets/icons/gps.png');
//        $this->table->add_action('/home/location', '/assets/icons/location.png');
        $this->table->add_action('/streaming/index', '/assets/icons/fullscreen.png', 'Streaming', [900, 450]);
        $this->table->add_action('/home/details', '/assets/icons/document.png', 'Details');
//        $this->table->add_action('/home/analyze', '/assets/icons/analyze.png');
//        $this->table->add_action('/home/delete', '/assets/icons/trash.png');

        $this->add_menu('/home/details', '/assets/icons/new.png', 'New');
        $this->add_menu('#', '/assets/icons/settings.png', 'Settings');

        $this->data['table'] = $this->table->generate($drones);

        $this->render('home/index_view');
    }

    public function details($id = null)
    {
        $drone = Drone::find($id);

        $this->data['drone'] = $drone;
        $this->data['id'] = $id;

        $this->add_menu('/', '/assets/icons/return.png', 'Return');
        $this->add_save();
        $this->add_delete();

        $this->render('home/details_view');
    }

    public function save()
    {
        $post = $this->input->post();
        $drone_id = (int)$post['id'];
        $drone = Drone::findOrNew($drone_id);
        $drone->id_code = $post['id_code'];
        $drone->model = $post['model'];
        $drone->stream_source = $post['stream_source'];
        $drone->active = (int)isset($post['active']);
        $drone->save();
        $drone_id = $drone->getKey();
        redirect('home/details/'.$drone_id);
    }

    public function delete()
    {
        $drone_id = (int)$this->input->post('id');
        Drone::destroy($drone_id);
        redirect('/');
    }
}