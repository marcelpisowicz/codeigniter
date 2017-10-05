<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Streaming extends Auth_Controller
{

    public function index($id)
    {
        $this->load->helper('streaming');

        $stream = new VideoStream("blob:https://player.webcamera.pl/1110d647-5fc2-4f6d-b3f4-89451ded7db2");
        $stream->start();
        echo "Streaming, drone id =".$id;
    }
}