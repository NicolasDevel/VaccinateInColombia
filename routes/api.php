<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\VaccinateController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('vaccinate',[VaccinateController::class,'index']);
Route::get('peopleFullVaccinate',[VaccinateController::class,'getFullVaccinate']);
Route::get('peopleTotalVaccinate',[VaccinateController::class,'getTotalVaccinate']);
Route::get('dailyVaccinates',[VaccinateController::class,'getDailyVaccinate']);
