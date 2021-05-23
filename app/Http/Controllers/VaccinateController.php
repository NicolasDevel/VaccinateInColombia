<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class VaccinateController extends Controller
{
    public function index(){
        $data = file_get_contents(env('API_ENDPOINT'));
        $vaccinate = json_decode($data, true);
        $position = array_search('COL',array_column($vaccinate,'iso_code'));


        return response($vaccinate[$position],200);
    }
}
