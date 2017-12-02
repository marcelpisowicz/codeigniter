<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drones extends Auth_Controller
{

    public function index()
    {
        $drones = Drone_model::all();
        $this->table->add_column(_('Nazwa'), 'name');
        $this->table->add_column(_('Numer seryjny'), 'serial_number');
        $this->table->add_column(_('Typ urządzenia'), 'type', Drone_model::getTypes());
        $this->table->add_column(_('Aktywny'), 'active', true);
//        $this->table->add_action('/home/gps', '/assets/icons/gps.png');
//        $this->table->add_action('/home/location', '/assets/icons/location.png');
        $this->table->add_action('/drones/streaming', '/assets/icons/fullscreen.png', 'Streaming', [900, 450]);
        $this->table->add_action('/drones/calendar', '/assets/icons/calendar.png', 'Kalendarz');
        $this->table->add_action('/drones/schedule', '/assets/icons/document.png', 'Rozkład');
        $this->table->add_action_delete();
        $this->table->add_click();

        $this->add_menu_new();
        $this->add_menu('#', '/assets/icons/settings.png', 'Settings');

        $this->data['table'] = $this->table->generate($drones);

        $this->render('drones/index_view');
    }

    public function details($id = null)
    {
        $drone = Drone_model::findOrNew($id);
        $this->model($drone);
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
        $drone = Drone_model::findOrNew($drone_id);
        $drone->name = $post['name'];
        $drone->serial_number = $post['serial_number'];
        $drone->model = $post['model'];
        $drone->stream_source = $post['stream_source'];
        $drone->active = (int)isset($post['active']);
        $drone->description = $post['description'];
        $drone->type = (int)$post['type'];
        $drone->save();
        $drone_id = $drone->getKey();
        alert('Zapisano informacje o urządzeniu', SUCCESS);
        Drone_model::checkDetailsTable($drone_id);
        $this->redirect_details($drone_id);
    }

    public function delete(int $id)
    {
        Drone_model::destroy($id);
        Drone_model::checkDetailsTable($id);
        alert('Usunięto urządzenie', NOTICE);
        $this->redirect();
    }

    public function streaming($id)
    {
        $drone = Drone_model::find($id);
        if(!empty($drone)) {
            $this->data['source'] = $drone->stream_source;
        }

        $this->render('drones/streaming_view', null);
    }

    public function ajax_get_calendar($id)
    {
        $post = $this->input->post();
        $this->load->library('MyCalendar');
        $phpCalendar = new MyCalendar($post['year'], $post['month']);
        echo $phpCalendar->getCalendarHTML();
    }

    public function calendar($id)
    {
        $this->load->library('MyCalendar');
        $this->add_menu_return();

        $phpCalendar = new MyCalendar();
        $this->data['calendar'] = $phpCalendar->getCalendarHTML();
        $this->data['id'] = $id;

        $this->render('drones/calendar_view');
    }

    public function schedule($id)
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
        $this->table->add_click('/drones/schedule_details/'.$id);
        $this->table->add_action_delete('/drones/schedule_delete/'.$id);

        $this->add_menu_return('drones');
        $this->add_menu_new('/drones/schedule_details/'.$id);
        $this->add_header($drone->name);
        $this->add_description(_('Harmonogram lotów'));

        $this->data['table'] = $this->table->generate($scheduler);

        $this->selected_menu = 'drones';
        $this->render('drones/schedule_view');
    }

    public function schedule_details($id)
    {
        $scheduler_id = $this->uri->segment('4');
        $scheduler = Schedule_model::findOrNew($scheduler_id);
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

        $this->add_menu_return($this->class.'/schedule/'.$id);
        $this->add_menu_save();
        $this->add_menu_delete($id.'/'.$scheduler_id);

        $this->selected_menu = 'drones';
        $this->render('drones/schedule_details_view');
    }

    public function schedule_save()
    {
        $post = array_filter($this->input->post());
        $timetable_id = $post['id'] ?? null;
        $timetable = Schedule_model::findOrNew($timetable_id);
        $user_id = $this->session->get_userdata()['user_id'];
        $post['user_id'] = $user_id;
        $drone_id = $post['drone_id'];

        $timetable->fill($post);

        $timetable->save();
        $timetable_id = $timetable->getKey();
        alert('Zapisano informacje na temat harmonogramu', SUCCESS);
        $this->redirect($this->class.'/schedule_details/'.$drone_id.'/'.$timetable_id);
    }

    public function schedule_delete(int $id)
    {
        $scheduler_id = $this->uri->segment('4');
        $scheduler = Schedule_model::where('drone_id', '=', $id)->find($scheduler_id);
        $scheduler->delete();
        alert('Usunięto harmonogram', NOTICE);
        $this->redirect($this->class.'/schedule/'.$id);
    }

}