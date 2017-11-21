<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;

class Drone_model extends Eloquent {
    public $timestamps = false;
    protected $table = "drone";

    private static $drone_types = [
        1 => 'Wielowirnikowiec',
        2 => 'Płatowiec'
    ];

    public static function checkDetailsTable($id)
    {
        if(!empty($id)) {

            $drone = Drone_model::find($id);
            $table = DB::table('information_schema.tables')
                ->where('TABLE_SCHEMA', '=', 'details')
                ->where('TABLE_NAME', '=', 'uav_'.$id)
                ->count();

            if(empty($table) !== empty($drone)) {
                if(empty($table)) {
                    DB::statement("CREATE TABLE details.uav_".$id." (lat NUMERIC(15,12), lng NUMERIC(15,12), time DATETIME)");
                }
            }
        }
    }

    public static function getTypes()
    {
        return Drone_model::$drone_types;
    }
}