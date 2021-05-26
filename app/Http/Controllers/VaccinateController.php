<?php

namespace App\Http\Controllers;

use App\Models\Vaccinate;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;


class VaccinateController extends Controller
{

    private function populateData($data,$key,$start=null){
        if(!$start){
            $start=0;
        }
        for($i=$start ;$i<count($data); $i++){
            if(!$data[$i][$key]){
                $beforeValue = $data[$i-1][$key];
                if(!$data[$i+1][$key]){
                    $count = 0;
                    while (!$data[$i+$count][$key]){
                        $count++;
                    }
                    $data[$i][$key] = ceil((($data[$i+$count][$key]-$beforeValue)/$count)+$data[$i-1][$key]);
                    $count = 0;
                }else{
                    $data[$i][$key] = ceil((($data[$i+1][$key]-$data[$i-1][$key])/2)+$data[$i-1][$key]);
                }
            }
        }
        return $data;
    }

    private function distributionDayWeek($data){
        Carbon::setLocale('es');
        $dates = array_map(function ($item){
            $newElement = array(
                'date' =>  $item['date'],
                'total_vaccination' => $item['total_vaccinations'],
            );
            return $newElement;
        },$data);
       $days = array(
           [
               'day' => 'Lunes'

           ]
       );
        dd(Carbon::create('2021-05-23')->dayName);
        return $dates;
    }

    public function index(){
        $vaccinaData =$this->populateData(Vaccinate::all(),'people_fully_vaccinated',23);
        $vaccinaData = $this->populateData($vaccinaData,'total_vaccinations');

        return $this->responseJson(['vaccinate' => $vaccinaData],Response::HTTP_OK);
    }

    public function getFullVaccinate(){
        $people_full_vaccinate = Vaccinate::select('date','people_fully_vaccinated')->where('id','>',24)->get();
        $length = count($people_full_vaccinate );
        for($i=0; $i<$length; $i++){
            if(!$people_full_vaccinate[$i]->people_fully_vaccinated){
                $beforeValue = $people_full_vaccinate[$i-1]->people_fully_vaccinated;
                if(!$people_full_vaccinate[$i+1]->people_fully_vaccinated){
                    $count = 0;
                    while (!$people_full_vaccinate[$i+$count]->people_fully_vaccinated){
                        $count++;
                    }
                    $people_full_vaccinate[$i]->people_fully_vaccinated = (($people_full_vaccinate[$i+$count]->people_fully_vaccinated-$beforeValue)/$count)+$people_full_vaccinate[$i-1]->people_fully_vaccinated;
                    $count=0;
                }else{
                    $people_full_vaccinate[$i]->people_fully_vaccinated = (($people_full_vaccinate[$i+1]->people_fully_vaccinated-$people_full_vaccinate[$i-1]->people_fully_vaccinated)/2)+$people_full_vaccinate[$i-1]->people_fully_vaccinated;
                }
            }
        }
        return $this->responseJson($people_full_vaccinate,Response::HTTP_OK);
    }
    public function getTotalVaccinate(){
        $total_vaccinations = Vaccinate::select('date','total_vaccinations')->get();
        $length = count($total_vaccinations);
        for($i=0; $i<$length; $i++){
            if(!$total_vaccinations[$i]->total_vaccinations){
                $beforeValue = $total_vaccinations[$i-1]->total_vaccinations;
                if(!$total_vaccinations[$i+1]->total_vaccinations){
                    $count = 0;
                    while (!$total_vaccinations[$i+$count]->total_vaccinations){
                        $count++;
                    }
                    $total_vaccinations[$i]->total_vaccinations = (($total_vaccinations[$i+$count]->total_vaccinations-$beforeValue)/$count)+$total_vaccinations[$i-1]->total_vaccinations;
                    $count=0;
                }else{
                    $total_vaccinations[$i]->total_vaccinations = (($total_vaccinations[$i+1]->total_vaccinations-$total_vaccinations[$i-1]->total_vaccinations)/2)+$total_vaccinations[$i-1]->total_vaccinations;
                }
            }
        }
        return $this->responseJson($total_vaccinations,Response::HTTP_OK);
    }


    public function getDailyVaccinate(){
        return $this->responseJson(Vaccinate::select('daily_vaccinations')->get(),Response::HTTP_OK);
    }
}
