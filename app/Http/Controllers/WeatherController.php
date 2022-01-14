<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use \Cache;
use \Log;
use App\models\Temp;
use Auth;
use DB;
use Charts;

class weatherController extends Controller
{
    public function index($pos){
      $minutes = 60;
      
      $loc = explode('_', $pos); 
      $lat= (float)$loc[0];
      $lang= (float)$loc[1];
      // dd ($lang);
        $app_id = "105ff2342b184865ae703246221301";
        $url = "http://api.weatherapi.com/v1/current.json?key=${app_id}&q=${lat},${lang}&aqi=no";
        Log::info($url);
        $client = new \GuzzleHttp\Client();
        $res = $client->get($url);
        if ($res->getStatusCode() == 200) {
          $j = $res->getBody();
          $obj = json_decode($j);
          $forecast = $obj;
          // dd($forecast->current->temp_c);

          $temp= new Temp;
          $temp->temp= $forecast->current->temp_c;
          $temp->user_id= Auth::id();
          $temp->save();
        }
        $temps = Temp::select('temp')->where('user_id', Auth::id())->get();
        $date = Temp::select('created_at')->where('user_id', Auth::id())->get();
        // dd($chart);
        return view('dashboard',compact('temps','date'));
      }
}