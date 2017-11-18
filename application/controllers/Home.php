<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Auth_Controller
{

    public function index()
    {
        $drones = Drone::all();
        $this->data['drones'] = $drones;
        $this->table->set_heading(['id_code', 'model', 'type']);
//        $this->table->add_action('/home/gps', '/assets/icons/gps.png');
//        $this->table->add_action('/home/location', '/assets/icons/location.png');
        $this->table->add_action('/streaming/index', '/assets/icons/fullscreen.png', 'Streaming', [900, 450]);
//        $this->table->add_action('/home/details', '/assets/icons/document.png', 'Details');
//        $this->table->add_action('/home/analyze', '/assets/icons/analyze.png');
        $this->table->add_action_delete();
        $this->table->add_click();

        $this->add_menu_new();
        $this->add_menu('#', '/assets/icons/settings.png', 'Settings');

        $this->data['table'] = $this->table->generate($drones);

        $this->render('home/index_view');
    }

    public function details($id = null)
    {
        $drone = Drone::find($id);

        $this->data['drone'] = $drone;
        $this->data['id'] = $id;
        $this->data['drone_types'] = arr_form($drone->getTypes());

        $this->add_menu_return();
        $this->add_menu_save();
        $this->add_menu_delete($id);

        $this->render('home/details_view');
    }

    public function save()
    {
        $post = $this->input->post();
        $drone_id = (int)$post['id'];
        $drone = Drone::findOrNew($drone_id);
//        var_dump($post); die;
//        $drone->fill($post);
        $drone->id_code = $post['id_code'];
        $drone->model = $post['model'];
        $drone->stream_source = $post['stream_source'];
        $drone->active = (int)isset($post['active']);
        $drone->type = (int)$post['type'];
        $drone->save();
        $drone_id = $drone->getKey();

        Drone::checkDetailsTable($drone_id);
        $this->redirect($drone_id);
    }

    public function delete($id)
    {
        Drone::destroy($id);
        Drone::checkDetailsTable($id);
        $this->redirect();
    }
}