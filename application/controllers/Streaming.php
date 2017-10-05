<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Streaming extends Auth_Controller
{

    public function index($id)
    {
        echo "Streaming, drone id =".$id;
    }
}