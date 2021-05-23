<?php

namespace App\Http\Controllers;

use App\Models\Vaccinate;


class VaccinateController extends Controller
{
    public function index(){
        return response(Vaccinate::all(),200);
    }
}
