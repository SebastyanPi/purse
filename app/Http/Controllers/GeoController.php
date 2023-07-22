<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeoController extends Controller
{

    public static function data() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.ipify.org/?format=json");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = json_decode(curl_exec($ch));

        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, "http://ip-api.com/json/".$res->ip);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch1);
        return $json;
    }
}
