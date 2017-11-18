<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drones extends Auth_Controller
{

    public function index()
    {
        $drones = Drone::all();
        $this->table->add_column(_('Identyfikator'), 'id_code');
        $this->table->add_column(_('Model'), 'model');
        $this->table->add_column(_('Typ urządzenia'), 'type');
        $this->table->add_column(_('Aktywny'), 'active', Drone::getTypes());
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

        $this->render('drones/index_view');
    }

    public function details($id = null)
    {
        $drone = Drone::findOrNew($id);
        $this->model($drone);
        $this->data['id'] = $id;
        $this->data['drone_types'] = arr_form($drone->getTypes());

        $this->add_menu_return();
        $this->add_menu_save();
        $this->add_menu_delete($id);

        $this->render('drones/details_view');
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
        $drone->type = (int)$post['type'];
        $drone->save();
        $drone_id = $drone->getKey();
        alert('Zapisano informacje o urządzeniu', SUCCESS);
        Drone::checkDetailsTable($drone_id);
        $this->redirect($drone_id);
    }

    public function delete($id)
    {
        Drone::destroy($id);
        Drone::checkDetailsTable($id);
        alert('Usunięto urządzenie', NOTICE);
        $this->redirect();
    }
}