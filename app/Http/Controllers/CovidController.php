<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CovidController extends Controller
{
    public function checkCountry($location){
      $req = Http::get('https://api.covid19api.com/dayone/country/'.$location.'/status/confirmed/live');
      $reqjson = $req->json();
      if($req->status()==200){
        $label = [];

        $datasets = [
                      "label"=> $location.' Улсын Covid-19 батлагжсан тохиолдлууд',
                      "data"=> [],
                      "pointRadius"=> "0",
                      "borderColor"=>"red",
                      "backgroundColor"=>"Red"
                    ];
        $lastMonth=date("y-m");
        foreach ($reqjson as $dailycase) {
          array_push($datasets["data"],$dailycase["Cases"]);
          array_push($label,date("y-F-d",strtotime($dailycase["Date"])));
        }
        return view("index",["type"=>"line","label"=>$label,"datasets"=>$datasets]);
      }
      return "Request failed";
    }
    public function landingPage(){
      $req = Http::get('https://api.covid19api.com/world/total');
      $reqjson = $req->json();
      if($req->status()==200){
          $label=array("Нийт нас барсан хүний тоо","Нийт батлагдсан тохиолдлууд","Нийт эдгэрсэн тохиолдлууд");
          $datasets=[
            "label"=>[ 'Covid-19'],
            "data"=> [],
            "backgroundColor"=>"Red"
          ];
          array_push($datasets["data"],$reqjson["TotalDeaths"]);
          array_push($datasets["data"],$reqjson["TotalConfirmed"]);
          array_push($datasets["data"],$reqjson["TotalRecovered"]);
          return view("index",["type"=>"bar","label"=>$label,"datasets"=>$datasets]);
      }
      return "Request failed";
    }
}
