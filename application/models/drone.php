<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Drone extends Eloquent {
    public $timestamps = false;
    protected $table = "drones"; // table name
}