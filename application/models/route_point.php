<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Route_Point extends Eloquent {
    public $timestamps = false;
    protected $table = "routes_points";
    protected $fillable = ['route_id', 'order', 'latitude', 'longitude'];
}