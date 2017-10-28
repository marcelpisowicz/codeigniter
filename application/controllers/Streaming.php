<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Streaming extends Auth_Controller
{

    public function index($id)
    {
        $drone = Drone::find($id);
        if(!empty($drone)) {
            $this->data['source'] = $drone->stream_source;
        }

        $this->render('streaming/index_view', null);
    }
}