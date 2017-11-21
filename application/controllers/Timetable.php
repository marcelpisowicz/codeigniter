<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timetable extends Auth_Controller
{

    public function index($id)
    {
        $drone = Drone_model::find($id);
        $scheduler = $this->db->get_where('calendar_schedule', ['drone_id' => $id])->result_array();

        $this->table->add_column(_('Dron'), 'drone_id');
        $this->table->add_column(_('User'), 'user_id');
        $this->table->add_column(_('Trasa'), 'route_id');
        $this->table->add_action_delete();

        $this->add_menu_return('/drones');
        $this->add_menu_new('/timetable/details/'.$id);
        $this->add_header($drone->id_code);
        $this->add_description(_('Harmonogram lotów'));

        $this->data['table'] = $this->table->generate($scheduler);

        $this->render('timetable/index_view');
    }

    public function details($id)
    {
        $scheduler_id = $this->uri->segment('4');
        $scheduler = Calendar_model::findOrNew($scheduler_id);
        $drone = Drone_model::find($id);

        $routes = Route_model::all()->toArray();
        $route_select = [];
        foreach($routes as $route) {
            $route_select[$route['id']] = $route['name'];
        }

        $this->data['route_select'] = arr_form($route_select);

        $this->model($scheduler);
        $this->model($drone, 'drone');

        $this->add_header($drone->id_code);
        $this->add_description(_('Szczegóły lotu'));

        $this->add_menu_return('/'.$this->class.'/index/'.$id);
        $this->add_menu_save();
        $this->add_menu_delete($id.'/'.$scheduler_id);

        $this->render('timetable/details_view');
    }



}