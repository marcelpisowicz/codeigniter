<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Route_point_model extends Eloquent {

    public $timestamps = false;
    protected $table = "route_point";
    protected $fillable = ['route_id', 'order', 'latitude', 'longitude'];
}