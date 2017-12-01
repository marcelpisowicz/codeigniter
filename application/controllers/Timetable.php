<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timetable extends Auth_Controller
{

    public function index(int $id)
    {
        $drone = Drone_model::find($id);
        $scheduler = Schedule_model::get_schedules($id);

        $this->table->add_column(_('Użytkownik'), 'username');
        $this->table->add_column(_('Trasa'), 'routename');

        $this->table->add_column(_('Dzień tygodnia'), 'day_of_week');
        $this->table->add_column(_('Miesiąc'), 'month');
        $this->table->add_column(_('Dzień'), 'day');
        $this->table->add_column(_('Godzina'), 'hour');
        $this->table->add_column(_('Minuta'), 'min');
        $this->table->add_action_delete('/timetable/delete/'.$id);

        $this->add_menu_return('/drones');
        $this->add_menu_new('/timetable/details/'.$id);
        $this->add_header($drone->name);
        $this->add_description(_('Harmonogram lotów'));

        $this->data['table'] = $this->table->generate($scheduler);

        $this->selected_menu = 'drones';
        $this->render('timetable/index_view');
    }

    public function details(int $id)
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

        $this->add_header($drone->name);
        $this->add_description(_('Szczegóły lotu'));

        $this->add_menu_return('/'.$this->class.'/index/'.$id);
        $this->add_menu_save();
        $this->add_menu_delete($id.'/'.$scheduler_id);

        $this->selected_menu = 'drones';
        $this->render('timetable/details_view');
    }

    public function save() {
        $post = $this->input->post();
        $timetable_id = (int)$post['id'];
        $timetable = Schedule_model::findOrNew($timetable_id);
        $user_id = $this->session->get_userdata()['user_id'];

        $timetable->route_id = $post['route_id'];
        $timetable->drone_id = $post['drone_id'];
        $timetable->min = $post['min'];
        $timetable->hour = $post['hour'];
        $timetable->day = $post['day'];
        $timetable->month = $post['month'];
        $timetable->day_of_week = $post['day_of_week'];
        $timetable->description = $post['description'];
        $timetable->user_id = $user_id;

        $timetable->save();
        $timetable_id = $timetable->getKey();
        alert('Zapisano informacje na temat harmonogramu', SUCCESS);
        $this->redirect_details($timetable_id);
    }

    public function delete(int $id) {

        $scheduler_id = $this->uri->segment('4');
        $scheduler = Schedule_model::where('drone_id', '=', $id)->find($scheduler_id);
        $scheduler->delete();
        alert('Usunięto harmonogram', NOTICE);
        $this->redirect($this->class.'/index/'.$id);
    }

}