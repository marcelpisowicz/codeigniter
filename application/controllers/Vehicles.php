<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicles extends Auth_Controller
{

    public function index()
    {
        $vehicles = Vehicle_model::all();
        $this->table->add_column(_('Nazwa'), 'name');
        $this->table->add_column(_('Numer rejestracyjny'), 'serial_number');
        $this->table->add_column(_('Typ pojazdu'), 'type', Vehicle_model::getTypes());
        $this->table->add_column(_('Aktywny'), 'active', true);
//        $this->table->add_action('/home/gps', '/assets/icons/gps.png');
//        $this->table->add_action('/home/location', '/assets/icons/location.png');
        $this->table->add_action('/vehicles/streaming', '/assets/icons/fullscreen.png', 'Streaming', [900, 450]);
        $this->table->add_action('/vehicles/calendar', '/assets/icons/calendar.png', 'Kalendarz');
        $this->table->add_action('/timetable/index', '/assets/icons/document.png', 'Rozkład');
        $this->table->add_action_delete();
        $this->table->add_click();

        $this->add_menu_new();
        $this->add_menu('#', '/assets/icons/settings.png', 'Settings');

        $this->data['table'] = $this->table->generate($vehicles);

        $this->render('vehicles/index_view');
    }

    public function details($id = null)
    {
        $vehicle = Vehicle_model::findOrNew($id);
        $this->model($vehicle);
        $this->data['vehicle_types'] = arr_form($vehicle->getTypes());

        $this->add_menu_return();
        $this->add_menu_save();
        $this->add_menu_delete($id);

        $this->render('vehicles/details_view');
    }

    public function save()
    {
        $post = $this->input->post();
        $vehicle_id = (int)$post['id'];
        $vehicle = Vehicle_model::findOrNew($vehicle_id);
        $vehicle->name = $post['name'];
        $vehicle->serial_number = $post['serial_number'];
        $vehicle->model = $post['model'];
        $vehicle->stream_source = $post['stream_source'];
        $vehicle->active = (int)isset($post['active']);
        $vehicle->description = $post['description'];
        $vehicle->type = (int)$post['type'];
        $vehicle->save();
        $vehicle_id = $vehicle->getKey();
        alert('Zapisano informacje o urządzeniu', SUCCESS);
        Vehicle_model::checkDetailsTable($vehicle_id);
        $this->redirect($vehicle_id);
    }

    public function delete($id)
    {
        Vehicle_model::destroy($id);
        Vehicle_model::checkDetailsTable($id);
        alert('Usunięto urządzenie', NOTICE);
        $this->redirect();
    }

    public function streaming($id)
    {
        $vehicle = Vehicle_model::find($id);
        if(!empty($vehicle)) {
            $this->data['source'] = $vehicle->stream_source;
        }

        $this->render('vehicles/streaming_view', null);
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

        $this->render('vehicles/calendar_view');
    }

}