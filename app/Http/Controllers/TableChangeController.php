<?php

namespace App\Http\Controllers;
use App\Models\table_change;
use App\Http\Controllers\GeoController;
use Illuminate\Http\Request;

class TableChangeController extends Controller
{   
    public static function construct()
    {
        return json_decode(GeoController::data());
    }
  
    public static function StoreAdd($table,$id){
        $data = self::construct();        
        table_change::create(['table' => $table, 'id_change' =>  $id, 'add' => 1, 'edit' => 0, 'delete' => 0, 'is_synchronized' => 0, 'latitude' => $data->lat, 'longitude' => $data->lon]);
    }

    public static function StoreEdit($table,$id){
        $data = self::construct();    
        table_change::create(['table' => $table, 'id_change' =>  $id, 'add' => 0, 'edit' => 1, 'delete' => 0, 'is_synchronized' => 0, 'latitude' => $data->lat, 'longitude' => $data->lon]);
    }

    public static function StoreDelete($table,$id){
        $data = self::construct();
        table_change::create(['table' => $table, 'id_change' =>  $id, 'add' => 0, 'edit' => 0, 'delete' => 1, 'is_synchronized' => 0, 'latitude' => $data->lat, 'longitude' => $data->lon]);
    }
}
