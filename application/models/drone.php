<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;

class Drone extends Eloquent {
    public $timestamps = false;
    protected $table = "drones";

    public $fields = [
        'id_code' => ['field_name' => 'Identyfikator'],
        'model' => ['field_name' => 'Model'],
        'stream_source' => ['field_name' => 'Źródło transmisji video'],
        'active' => ['field_name' => 'Aktywny'],
        'type' => [
            'field_name' => 'Typ urządzenia',
            'field_type' => [
                1 => 'Wielowirnikowiec',
                2 => 'Płatowiec'
            ]
        ]
    ];

    public static function checkDetailsTable($id)
    {
        if(!empty($id)) {

            $drone = Drone::find($id);
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

    public function getTypes()
    {
        return $this->fields['type']['field_type'];
    }
}