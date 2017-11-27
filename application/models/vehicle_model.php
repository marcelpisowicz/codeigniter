<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;

class Vehicle_model extends Eloquent {
    public $timestamps = false;
    protected $table = "vehicle";

    private static $vehicle_types = [
        1 => 'Osobowy',
        2 => 'Ciężarowy'
    ];

    public static function checkDetailsTable($id)
    {
        if(!empty($id)) {

            $vehicle = Vehicle_model::find($id);
            $table = DB::table('information_schema.tables')
                ->where('TABLE_SCHEMA', '=', 'details')
                ->where('TABLE_NAME', '=', 'uav_'.$id)
                ->count();

            if(empty($table) !== empty($vehicle)) {
                if(empty($table)) {
                    DB::statement("CREATE TABLE details.uav_".$id." (lat NUMERIC(15,12), lng NUMERIC(15,12), time DATETIME)");
                }
            }
        }
    }

    public static function getTypes()
    {
        return Vehicle_model::$vehicle_types;
    }
}