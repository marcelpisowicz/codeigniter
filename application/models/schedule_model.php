<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;

class Schedule_model extends Eloquent {

    public $timestamps = true;
    protected $table = "schedule";

    public static function get_schedules(int $drone_id)
    {
        return DB::table('schedule')
            ->select('route.name as routename', 'users.username', 'schedule.*')
            ->leftJoin('users', 'users.id', '=', 'schedule.user_id')
            ->join('route', 'route.id', '=', 'schedule.route_id')
            ->where('drone_id', '=', $drone_id)
            ->get();
    }
}